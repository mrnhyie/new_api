<?php

namespace App\Http\Controllers;

use App\Models\TourRequest;
use Illuminate\Http\Request;

class TourRequestController extends Controller
{
    // Get all tour requests
    public function index()
    {
        $tourRequests = TourRequest::all();
        return response()->json($tourRequests);
    }

    // Create a new tour request
    public function store(Request $request)
    {
        // Inline validation: Automatically handles failures and returns 422 JSON
        $validatedData = $request->validate([
            "has_visited_before" => "required",
            "tour_date" => "required",
            "tour_time" => "nullable",
            "place_id" => "nullable",
            "purpose" => "nullable",
            "number_of_people_visiting" => "nullable",
            "first_name" => "required",
            "other_names" => "nullable",
            "email" => "required|email",
            "phone_number" => "required",
            "whatsapp_number" => "nullable",
            "country" => "required",
            "city" => "required",
            "emergency_contact_name" => "nullable",
            "emergency_contact_phone" => "nullable",
            "medical_conditions" => "nullable",
            "how_did_you_hear_about_us" => "nullable",
        ]);

        // Saves only the validated data fields
        $tourRequest = TourRequest::create($validatedData);

        return response()->json($tourRequest, 201);
    }

    // Get a specific tour request
    public function show(TourRequest $tourRequest)
    {
        return response()->json($tourRequest);
    }

    // Delete a tour request
    public function destroy(TourRequest $tourRequest)
    {
        $tourRequest->delete();
        return response()->json(null, 204);
    }
}