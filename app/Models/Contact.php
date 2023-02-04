<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';
    protected $fillable = [
        'uuid',
        'user_id',
        'info_type',
        'info_value'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
