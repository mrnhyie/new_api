<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TimeSlot;
use Illuminate\Http\Request;

class TimeSlotController extends Controller
{
    public function index()
    {
        return TimeSlot::orderBy('time')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'time' => 'required|date_format:H:i',
            'is_available' => 'boolean',
        ]);

        return TimeSlot::create($validated);
    }

    public function update(Request $request, TimeSlot $timeSlot)
    {
        $validated = $request->validate([
            'time' => 'sometimes|date_format:H:i',
            'is_available' => 'sometimes|boolean',
        ]);

        $timeSlot->update($validated);
        return $timeSlot;
    }

    public function destroy(TimeSlot $timeSlot)
    {
        $timeSlot->delete();
        return response()->json(['message' => 'Deleted']);
    }

    // Toggle availability – convenience method
    // public function toggle(TimeSlot $timeSlot)
    // {
    //     $timeSlot->is_available = !$timeSlot->is_available;
    //     $timeSlot->save();
    //     return $timeSlot;
    // }

    public function free()
    {
        $freeTimeSlots = TimeSlot::where('is_available', true)->orderBy('time')->get();
        return response()->json($freeTimeSlots);
    }
}
