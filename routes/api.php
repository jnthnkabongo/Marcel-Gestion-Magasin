<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::post('/login', [ApiController::class, 'login_api']);
Route::post('/register', [ApiController::class, 'register_api']);
Route::get('/test', [ApiController::class, 'testConnection']); // Endpoint de test (sans auth)

Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/logout', [ApiController::class, 'logoutApi']);
    Route::get('/dashboard', [ApiController::class, 'dashboardApi']);
    Route::get('/liste-historiques', [ApiController::class, 'getHistoriquesApi']);
    Route::get('/liste-produits', [ApiController::class, 'listeProduitsApi']);
    Route::get('/liste-vente', [ApiController::class, 'listeVenteApi']);
    Route::get('/liste-utilisateurs', [ApiController::class, 'getUsersApi']);
    Route::get('liste-roles', [ApiController::class, 'getRolesApi']);
    Route::post('/client-or-create', [ApiController::class, 'clientOrCreate']);
    Route::post('/vente-produit', [ApiController::class, 'venteProduitApi']);
    Route::get('/rapport-ventes', [ApiController::class, 'rapportVenteApi']);
});
