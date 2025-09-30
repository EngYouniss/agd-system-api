<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractType extends Model
{
    protected $fillable=[
        'name',
        'description'
    ];
    public function contract(){
        return $this->hasMany(Contract::class);
    }
}
