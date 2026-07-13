<?php

namespace App\Http\Controllers;

use App\Models\TourRequest;
use Illuminate\Http\Request;
use \App\Models\TimeSlot;

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
            "tour_time" => "required|integer|exists:time_slots,id",
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

        // mark the chosen time as unavailable
        $timeSlot = TimeSlot::find($request->input('tour_time'));
        if ($timeSlot) {
            $timeSlot->is_available = false;
            $timeSlot->save();
        }
        $tourRequest = TourRequest::create([
            "has_visited_before" => $validatedData["has_visited_before"],
            "tour_date" => $validatedData["tour_date"],
            "tour_time" => $timeSlot->time,
            "place_id" => $validatedData["place_id"],
            "purpose" => $validatedData["purpose"],
            "number_of_people_visiting" => $validatedData["number_of_people_visiting"],
            "first_name" => $validatedData["first_name"],
            "other_names" => $validatedData["other_names"],
            "email" => $validatedData["email"],
            "phone_number" => $validatedData["phone_number"],
            "whatsapp_number" => $validatedData["whatsapp_number"],
            "country" => $validatedData["country"],
            "city" => $validatedData["city"],
            "emergency_contact_name" => $validatedData["emergency_contact_name"],
            "emergency_contact_phone" => $validatedData["emergency_contact_phone"],
            "medical_conditions" => $validatedData["medical_conditions"],
            "how_did_you_hear_about_us" => "nullable",
        ]);
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
        // set the time slot back to available
        $timeSlot = TimeSlot::find($tourRequest->time_slot_id);
        if ($timeSlot) {
            $timeSlot->is_available = true;
            $timeSlot->save();
        }
        $tourRequest->delete();
        return response()->json(["message" => "Tour request deleted successfully"], 204);
    }
}
