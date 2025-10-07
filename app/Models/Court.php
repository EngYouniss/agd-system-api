<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    protected $fillable=[
        'name',
        'address',
    ];

    public function districts(){
        return $this->belongsToMany(District::class);
    }
}
