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
use App\Http\Controllers\AuthController;


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
     Route::post('login', [AuthController::class, 'login']);
     Route::post('register', [AuthController::class, 'register']);
    });

    Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => 'auth:sanctum'], function(){
        Route::apiResource('bouteilles', BouteilleController::class); // CRUD pour Bouteilles
        Route::apiResource('users', UserController::class); // CRUD pour Users
        Route::apiResource('celliers', CellierController::class); //CRUD pour Celliers
        Route::apiResource('cellier-bouteilles', CellierBouteilleController::class); //route pour les cellier_bouteille
        Route::apiResource('types', TypeController::class); //CRUD pour Types
        Route::apiResource('pays', PaysController::class); //CRUD pour Pays
        Route::apiResource('formats', FormatController::class); //CRUD pour Formats
        Route::apiResource('crawl', AdminController::class); //route pour le crawler
        Route::apiResource('erreur', ErreurController::class); //route pour les erreurs
        Route::apiResource('couleurs', PastilleCouleurController::class);   //route pour les couleurs
        Route::apiResource('note-commentaires', NoteCommentaireController::class); // route pour notes commenraires
});
