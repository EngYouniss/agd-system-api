<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable=[
        'first_name',
        'second_name',
        'third_name',
        'last_name',
        'gender'
    ];
}
