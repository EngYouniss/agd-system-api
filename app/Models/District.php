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
        return $this->belongsToMany(Court::class,'court_id');
    }
}
