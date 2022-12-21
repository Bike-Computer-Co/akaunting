<?php

namespace App\Models\Auth;

use Akaunting\Sortable\Traits\Sortable;
use App\Enums\SuperType;
use App\Notifications\Auth\Reset;
use App\Traits\Media;
use App\Traits\Owners;
use App\Traits\Sources;
use App\Traits\Tenants;
use App\Traits\Users;
use App\Utilities\Date;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Lorisleiva\LaravelSearchString\Concerns\SearchString;

class User extends Authenticatable implements HasLocalePreference
{
    use HasFactory, LaratrustUserTrait, Media, Notifiable, Owners, SearchString, SoftDeletes, Sortable, Sources, Tenants, Users;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'locale', 'enabled', 'landing_page', 'created_from', 'created_by'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'enabled' => 'boolean',
        'super_type' => SuperType::class,
    ];

    protected $guarded = ['super_type'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['last_logged_in_at', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Sortable columns.
     *
     * @var array
     */
    public $sortable = ['name', 'email', 'enabled'];

    public static function boot()
    {
        parent::boot();

        static::retrieved(function ($model) {
            $model->setCompanyIds();
        });

        static::saving(function ($model) {
            $model->unsetCompanyIds();
        });
    }

    public function companies()
    {
        return $this->belongsToMany('App\Models\Common\Company', 'App\Models\Auth\UserCompany');
    }

    public function contact()
    {
        return $this->hasOne('App\Models\Common\Contact', 'user_id', 'id');
    }

    public function dashboards()
    {
        return $this->belongsToMany('App\Models\Common\Dashboard', 'App\Models\Auth\UserDashboard');
    }

    public function invitation()
    {
        return $this->hasOne('App\Models\Auth\UserInvitation', 'user_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Auth\Role', 'App\Models\Auth\UserRole');
    }

    /**
     * Always capitalize the name when we retrieve it
     */
    public function getNameAttribute($value)
    {
        if (empty($value)) {
            return trans('general.na');
        }

        return ucfirst($value);
    }

    /**
     * Always return a valid picture when we retrieve it
     */
    public function getPictureAttribute($value)
    {
        // Check if we should use gravatar
        if (setting('default.use_gravatar', '0') == '1') {
            try {
                // Check for gravatar
                $url = 'https://www.gravatar.com/avatar/'.md5(strtolower($this->getAttribute('email'))).'?size=90&d=404';

                $client = new \GuzzleHttp\Client(['verify' => false]);

                $client->request('GET', $url)->getBody()->getContents();

                $value = $url;
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                // 404 Not Found
            }
        }

        if (! empty($value)) {
            return $value;
        } elseif (! $this->hasMedia('picture')) {
            return false;
        }

        return $this->getMedia('picture')->last();
    }

    /**
     * Always return a valid picture when we retrieve it
     */
    public function getLastLoggedAttribute($value)
    {
        // Date::setLocale('tr');

        if (! empty($value)) {
            return Date::parse($value)->diffForHumans();
        } else {
            return trans('auth.never');
        }
    }

    /**
     * Always capitalize the name when we save it to the database
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }

    /**
     * Always hash the password when we save it to the database
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Send reset link to user via email
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new Reset($token));
    }

    /**
     * Scope to get all rows filtered, sorted and paginated.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param $sort
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCollect($query, $sort = 'name')
    {
        $request = request();

        $search = $request->get('search');
        $limit = (int) $request->get('limit', setting('default.list_limit', '25'));

        return $query->usingSearchString($search)->sortable($sort)->paginate($limit);
    }

    /**
     * Scope to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEnabled($query)
    {
        return $query->where('enabled', 1);
    }

    /**
     * Scope to only customers.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsCustomer($query)
    {
        return $query->wherePermissionIs('read-client-portal');
    }

    /**
     * Scope to only users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsNotCustomer($query)
    {
        return $query->wherePermissionIs('read-admin-panel');
    }

    /**
     * Attach company_ids attribute to model.
     *
     * @return void
     */
    public function setCompanyIds()
    {
        $company_ids = $this->withoutEvents(function () {
            return $this->companies->pluck('id')->toArray();
        });

        $this->setAttribute('company_ids', $company_ids);
    }

    /**
     * Detach company_ids attribute from model.
     *
     * @return void
     */
    public function unsetCompanyIds()
    {
        $this->offsetUnset('company_ids');
    }

    /**
     * Determine if user is a customer.
     *
     * @return bool
     */
    public function isCustomer()
    {
        return (bool) $this->can('read-client-portal');
    }

    /**
     * Determine if user is not a customer.
     *
     * @return bool
     */
    public function isNotCustomer()
    {
        return (bool) $this->can('read-admin-panel');
    }

    public function scopeSource($query, $source)
    {
        return $query->where($this->qualifyColumn('created_from'), $source);
    }

    public function scopeIsOwner($query)
    {
        return $query->where($this->qualifyColumn('created_by'), user_id());
    }

    public function scopeIsNotOwner($query)
    {
        return $query->where($this->qualifyColumn('created_by'), '<>', user_id());
    }

    public function ownerKey($owner)
    {
        if ($this->isNotOwnable()) {
            return 0;
        }

        return $this->created_by;
    }

    /**
     * Get the user's preferred locale.
     *
     * @return string
     */
    public function preferredLocale()
    {
        return $this->locale;
    }

    /**
     * Get the line actions.
     *
     * @return array
     */
    public function getLineActionsAttribute()
    {
        $actions = [];

        if (user()->id == $this->id) {
            return $actions;
        }

        $actions[] = [
            'title' => trans('general.edit'),
            'icon' => 'edit',
            'url' => route('users.edit', $this->id),
            'permission' => 'update-auth-users',
        ];

        if ($this->hasPendingInvitation()) {
            $actions[] = [
                'title' => trans('general.resend').' '.trans_choice('general.invitations', 1),
                'icon' => 'replay',
                'url' => route('users.invite', $this->id),
                'permission' => 'update-auth-users',
            ];
        }

        $actions[] = [
            'type' => 'delete',
            'icon' => 'delete',
            'route' => 'users.destroy',
            'permission' => 'delete-auth-users',
            'model' => $this,
        ];

        return $actions;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Database\Factories\User::new();
    }

    protected static function booted()
    {
        parent::booted();
    }
}
