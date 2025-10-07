<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{

    protected $fillable=[
        'name',
        'description',
    ];

    public function courts(){
        return $this->belongsToMany(Court::class);
    }

    public function governorate(){
        return $this->belongsTo(Governorate::class,'governorate_id');
    }
}
