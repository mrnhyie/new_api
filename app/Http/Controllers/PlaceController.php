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

    public function show($id)
    {
        $place = Place::find($id);
        return response()->json($place);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "category" => "required",
            "location" => "required",
            "center_number" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $place = Place::create($request->all());
        return response()->json($place, 201);
    }

    public function destroy(Place $place)
    {
        $place->delete();
        return response()->json(null, 204);
    }
}
