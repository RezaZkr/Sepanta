<?php

use App\Http\Controllers\Api\Panel\Attribute\V1\AttributeController;
use App\Http\Controllers\Api\Panel\Product\V1\ProductController;
use App\Http\Controllers\Api\Web\Auth\V1\AuthController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {

    Route::middleware('guest:customer')->group(function () {

        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);

    });

    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:customer');

});


Route::prefix('panel/v1')->as('panel.')->group(function () {

    Route::apiResource('products', ProductController::class)->only('store');

    Route::apiResource('attributes', AttributeController::class);

});




