<?php

use App\Http\Controllers\Api\Web\Auth\V1\AuthController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {

    Route::middleware('guest:customer')->group(function () {

        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);

    });

    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:customer');

});

