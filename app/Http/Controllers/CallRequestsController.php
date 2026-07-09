<?php

namespace App\Http\Controllers;

use App\Models\CallRequests;
use Illuminate\Http\Request;

class CallRequestsController extends Controller
{
    public function index()
    {
        $callRequests = CallRequests::all();
        return response()->json($callRequests);
    }
    public function show(int $call_request_id)
    {
        $callRequest = CallRequests::findOrFail($call_request_id);
        return response()->json($callRequest);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'whatsapp_number' => 'required|string|max:20',
            'call_date' => 'required|date',
            'call_time' => 'required',
            'period' => 'required|in:AM,PM',
        ]);

        CallRequests::create($validated);

        return response()->json([
            'message' => 'Call request submitted successfully!',
        ], 201);
    }

    public function destroy(int $call_request_id)
    {
        $callRequest = CallRequests::findOrFail($call_request_id);
        $callRequest->delete();

        return response()->json([
            'message' => 'Call request deleted successfully!',
        ], 200);
    }
}
