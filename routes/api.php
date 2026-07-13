<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\TourRequestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CallRequestsController;
use App\Http\Controllers\TimeSlotController;

// api/v1 routes --> implementing versioning for future updates and backward compatibility
Route::prefix("v1")->group(function () {
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {});
    Route::apiResource("place", PlaceController::class);

    Route::apiResource("tour", TourRequestController::class)->except(["update"]);
    Route::apiResource("call-requests", CallRequestsController::class);



    // Special endpoint  to get available timeslots
    Route::get('time-slots/free', [TimeSlotController::class, 'free']);

    // other endpoints for time slots
    Route::apiResource("time-slots", TimeSlotController::class);
});