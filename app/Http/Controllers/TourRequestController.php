<?php

namespace App\Http\Controllers;

use App\Models\TourRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Added missing import

class TourRequestController extends Controller
{
    public function index()
    {
        $tourRequests = TourRequest::all();
        return response()->json($tourRequests);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $tourRequest = TourRequest::create($request->all());

        return response()->json($tourRequest, 201);
    }

    public function show(TourRequest $tourRequest)
    {
        return response()->json($tourRequest);
    }

    public function destroy(TourRequest $tourRequest)
    {
        $tourRequest->delete();
        return response()->json(null, 204);
    }
}
