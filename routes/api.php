<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\TourRequestController;

Route::get("/user", function (Request $request) {
    return $request->user();
})->middleware("auth:sanctum");


//  api/v1
Route::group("/v1", function () {
    Route::apiResource("places", PlaceController::class)->except([
        "create",
        "edit",
        "delete",
        "update",
    ]);
    Route::apiResource("tour", TourRequestController::class)->except([
        "create",
        "edit",
        "delete",
        "update",
    ]);
});
