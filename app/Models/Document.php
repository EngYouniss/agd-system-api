<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable=[
        'person_id',
        'document_type_id',
        'document_number',
        'issue',
        'issuer_date',
        'expiry_date',
    ];

    public function document_type(){
        return $this->belongsTo(DocumentType::class);
    }
}
