<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contract extends Model
{

    protected $fillable = [
    'contract_number',
    'husband_conditions',
    'wife_conditions',
    'mahr_total',
    'mahr_paid',
    'mahr_remaining',
    'contract_status_id',
    'contract_type_id',
];

    public function contractType(){
        return $this->belongsTo(ContractType::class,'contract_type_id');
    }

    public function status(){
        return $this->belongsTo(ContractStatus::class,'contract_status_id');
    }
}
