<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCodeApplicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_surname',
        'email',
        'phone_number',
        'registered_firm',
        'accountant',
        'advocate',
        'code',
    ];
}
