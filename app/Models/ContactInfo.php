<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactInfo extends BaseUUIDModel
{
    use HasFactory;


    protected $fillable = [
        'uuid',
        'contact_uuid',
        'info_type',
        'info_value'
    ];

    public function contact(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Contact::class,'contact_uuid','uuid');
    }
}
