<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Municipality extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function settlements(): HasMany
    {
        return $this->hasMany(Settlement::class);
    }

    public function firmRegistrations(): HasMany
    {
        return $this->hasMany(FirmRegistration::class);
    }
}
