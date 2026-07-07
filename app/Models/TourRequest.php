<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourRequest extends Model
{
    protected $fillable = [

        // Tour Details
        'has_visited_before',
        'tour_date',
        'tour_time',
        'place_id',
        'purpose',
        'number_of_people_visiting',

        // Personal Details
        'first_name',
        'other_names',
        'email',
        'phone_number',
        'whatsapp_number',
        'country',
        'city',
        'emergency_contact_name',
        'emergency_contact_phone',
        'medical_conditions',
        'how_did_you_hear_about_us',
    ];
}