<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractStatus extends Model
{
    public $fillable=[
        'name',
        'description'
    ];

    public function contract()
    {
        return $this->hasMany(Contract::class);
    }
}
