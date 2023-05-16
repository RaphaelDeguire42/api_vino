<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\FormatController;
use App\Http\Controllers\PaysController;
use App\Http\Controllers\CellierController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'App\Http\Controllers'], function(){
    Route::apiResource('bouteilles', BouteilleController::class); // CRUD pour Bouteilles
    Route::apiResource('celliers', CellierController::class); //CRUD pour Celliers
    Route::apiResource('types', TypeController::class); //CRUD pour Types
    Route::apiResource('pays', PaysController::class); //CRUD pour Pays
    Route::apiResource('formats', FormatController::class); //CRUD pour Formats
});

// Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => 'auth:sanctum'], function(){
//     Route::apiResource('bouteilles', BouteilleController::class); // CRUD pour Bouteilles
//     Route::apiResource('celliers', CellierController::class); //CRUD pour Celliers
// });

Route::apiResource('crawl', AdminController::class, 'dataCrawler'); //route pour le crawler
Route::apiResource('erreur', AdminController::class, 'nouvelleErreur'); //route pour les erreurs
