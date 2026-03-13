<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [\App\Http\Controllers\ApiController::class, 'login_api']);
Route::post('/register', [\App\Http\Controllers\ApiController::class, 'register_api']);
Route::post('/logout', [\App\Http\Controllers\ApiController::class, 'logout_api']);

