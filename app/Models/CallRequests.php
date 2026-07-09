<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallRequests extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'whatsapp_number',
        'call_date',
        'call_time',
        'period',
    ];

    protected $casts = [
        'call_date' => 'date',
        'call_time' => 'datetime:H:i',
    ];
}
