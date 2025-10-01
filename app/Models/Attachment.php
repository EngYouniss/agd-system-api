<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'name',
        'contract_id',
        'attachment_type_id',
    ];
}
