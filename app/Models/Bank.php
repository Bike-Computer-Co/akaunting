<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bank extends Model
{
    use HasFactory, HasMedia;

    protected $fillable = ['name', 'logo_svg'];

    public function firmRegistrations(): HasMany
    {
        return $this->hasMany(FirmRegistration::class);
    }

    public function logo(): Attribute
    {
        return Attribute::get(fn ($value) => config('app.url').$value);
    }
}
