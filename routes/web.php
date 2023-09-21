<?php

use App\Http\Controllers\MarquesController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\VentesController;
use App\Models\Marque;
use App\Models\Produit;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('ventejour');
});

Route::resource('vente', VentesController::class);
Route::resource('produit', ProduitsController::class);
Route::resource('marque', MarquesController::class);