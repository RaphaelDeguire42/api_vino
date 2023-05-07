<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BouteilleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('catalogue', [BouteilleController::class, 'index'])->name('bouteille.index');
Route::get('ajout-bouteille', [BouteilleController::class, 'ajouteBouteille'])->name('admin.ajouteBouteille');
Route::post('ajout-bouteille', [AdminController::class, 'dataCrawl']);
Route::get('bouteille/{bouteille}', [BouteilleController::class, 'show'])->name('bouteille.show');

Route::post('signaler-erreur', [AdminController::class, 'nouvelleErreur']);
