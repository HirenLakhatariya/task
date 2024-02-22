<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'mobile_number',
        'email',
        'gender',
        'state',
        'city',
        'address',
        'password',
        // Add any other attributes that you want to allow for mass assignment
    ];
}
