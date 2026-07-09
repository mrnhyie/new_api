<?php

namespace App\Http\Controllers;

use App\Models\TourRequest;
use Illuminate\Http\Request;

class TourRequestController extends Controller
{

    public function index()
    {
        $tourRequests = TourRequest::all();
        return response()->json($tourRequests);
    }

    public function store(Request $request)
    {

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

        $tourRequest = TourRequest::create($validatedData);

        return response()->json($tourRequest, 201);
    }

    public function show(int $tour_id)
    {
        $tourRequest = TourRequest::find($tour_id);

        if (!$tourRequest) {
            return response()->json(['message' => 'Tour request not found'], 404);
        }

        return response()->json($tourRequest);
    }


    public function destroy(int $tour_id)
    {
        $tourRequest = TourRequest::find($tour_id);
        if (!$tourRequest) {
            return response()->json(['message' => 'Tour request not found'], 404);
        }
        $tourRequest->delete();
        return response()->json(["message" => "Tour request deleted successfully"], 204);
    }
}