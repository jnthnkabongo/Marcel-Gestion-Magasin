<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/', [ApiController::class, 'index'])->name('index');
Route::post('/soumission-login', [ApiController::class, 'login'])->name('soumission-login');
Route::post('/creation-compte', [ApiController::class, 'register'])->name('creation-compte');
Route::get('/dashboard', [ApiController::class, 'dashboard'])->name('home');
