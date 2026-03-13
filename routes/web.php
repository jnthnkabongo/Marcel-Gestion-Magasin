<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/', [ApiController::class, 'index'])->name('index');
Route::post('/soumission-login', [ApiController::class, 'login'])->name('soumission-login');
Route::post('/creation-compte', [ApiController::class, 'register'])->name('creation-compte');
Route::get('/dashboard', [ApiController::class, 'dashboard'])->name('home');
Route::get('/utilisateurs', [ApiController::class, 'listeUtilisateurs'])->name('utilisateurs');
Route::get('/produits', [ApiController::class, 'listeProduits'])->name('produits');
Route::post('/produit/ajout', [ApiController::class, 'ajoutProduit'])->name('produits.ajout');
Route::get('/parametres', [ApiController::class, 'parametres'])->name('parametres');
Route::post('/marques/ajout', [ApiController::class, 'ajoutMarque'])->name('marques.ajout');
Route::post('/categories/ajout', [ApiController::class, 'ajoutCategorie'])->name('categories.ajout');
Route::post('/logout', [ApiController::class, 'logout'])->name('logout');
