<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends BaseUUIDModel
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'last_name',
        'company',
        'photo',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contactInfos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ContactInfo::class);
    }
}
