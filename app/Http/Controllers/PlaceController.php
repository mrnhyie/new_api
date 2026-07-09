<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::all();
        return response()->json($places);
    }

    public function show(Place $place)
    {
        return response()->json($place);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "category" => "required",
            "location" => "required",
            "center_number" => "required",
        ]);

        $place = Place::create($validatedData);

        return response()->json($place, 201);
    }
    public function destroy(Place $place)
    {
        $place->delete();
        return response()->json(null, 204);
    }
}
