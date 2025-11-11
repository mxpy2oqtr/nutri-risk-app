<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
Route::apiResource("foods", FoodController::class);
Route::get("/health", function () {
    return response()->json(["status" => "OK"]);
});
