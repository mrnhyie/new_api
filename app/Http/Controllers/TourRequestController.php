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
            "time_slot_id" => "required|integer|exists:time_slots,id",
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
        $timeSlot = TimeSlot::find($request->input('time_slot_id'));
        if ($timeSlot) {
            $timeSlot->is_available = false;
            $timeSlot->save();
        }
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
