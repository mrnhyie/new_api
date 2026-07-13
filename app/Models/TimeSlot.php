<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;

    protected $fillable = ['time', 'is_available'];

    protected $casts = [
        'time' => 'datetime:H:i',
        'is_available' => 'boolean',
        'time_slot_id',
    ];
}