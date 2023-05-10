<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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
Route::get('creation', [UserController::class, 'creationCompte']);
Route::post('creation', [UserController::class, 'store'])->name('compte.creation');
//Route::get('crawler', [AdminController::class, 'dataCrawl']);
Route::get('login', [AuthController::class, 'index'])->name('connexion');
Route::get('logout', [AuthController::class, 'deconnexion'])->name('deconnexion');
Route::post('authentification', [AuthController::class, 'authentification'])->name('authentification');


Route::get('catalogue', [BouteilleController::class, 'index'])->name('bouteille.index');
Route::get('bouteille/{bouteille}', [BouteilleController::class, 'show'])->name('bouteille.show');
Route::delete('bouteille/{bouteille}', [BouteilleController::class, 'destroy'])->name('bouteille.destroy');


Route::post('signaler-erreur', [AdminController::class, 'nouvelleErreur']);


/* Routes protégés par le auth */
Route::middleware(['auth'])->group(function () {
    Route::get('compte', [UserController::class, 'gestionCompte'])->name('compte.gestion');
    Route::post('compte', [UserController::class, 'modificationCompte'])->name('compte.modification');
    Route::get('ajout-bouteille', [BouteilleController::class, 'ajouteBouteille'])->name('admin.ajouteBouteille');
    Route::post('ajout-bouteille', [AdminController::class, 'dataCrawl']);


});