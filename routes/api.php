<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\TourRequestController;

Route::get("/user", function (Request $request) {
    return $request->user();
})->middleware("auth:sanctum");

// api/v1
Route::prefix("v1")->group(function () {
    Route::apiResource("place", PlaceController::class)->except(["update", "edit", "delete"]);
    Route::apiResource("tour", TourRequestController::class)->except(["update", "edit", "delete"]);
});
