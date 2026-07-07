<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    // Get all places
    public function index()
    {
        $places = Place::all();
        return response()->json($places);
    }

    // Get a specific place
    public function show(Place $place)
    {
        return response()->json($place);
    }

    // Create a new place
    public function store(Request $request)
    {
        // Inline validation: Automatically handles failures and returns 422 JSON
        $validatedData = $request->validate([
            "category" => "required",
            "location" => "required",
            "center_number" => "required",
        ]);

        // Saves only the validated data fields
        $place = Place::create($validatedData);

        return response()->json($place, 201);
    }

    // Delete a place
    public function destroy(Place $place)
    {
        $place->delete();
        return response()->json(null, 204);
    }
}
