<?php

use App\Http\Controllers\Api\PersonController;
use App\Http\Controllers\Api\GreetingController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('people', PersonController::class);
    Route::apiResource('greetings', GreetingController::class);
});
