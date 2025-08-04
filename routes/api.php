<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('events', \App\Http\Controllers\EventController::class)->except(['index', 'show']);
});

Route::apiResource('events', \App\Http\Controllers\EventController::class)->only(['index', 'show']);
Route::get('/prueba', fn () => 'OK');
