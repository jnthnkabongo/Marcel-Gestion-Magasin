<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [ApiController::class, 'login_api']);
Route::post('/register', [ApiController::class, 'register_api']);
Route::post('/logout', [ApiController::class, 'logout_api']);

Route::get('/liste-historiques', [ApiController::class, 'getHistoriquesApi'])->middleware('auth:sanctum');
Route::get('/liste-produits', [ApiController::class, 'listeProduitsApi'])->middleware('auth:sanctum');

