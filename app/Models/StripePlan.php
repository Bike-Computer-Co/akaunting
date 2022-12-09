<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripePlan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'stripe_id'];

    public function companies()
    {
        return $this->hasMany('App\Models\Common\Company');
    }
}
