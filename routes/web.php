<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

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
Route::get('crawler', [AdminController::class, 'dataCrawl']);
Route::get('login', [AuthController::class, 'index'])->name('connexion');
Route::post('authentification', [AuthController::class, 'authentification'])->name('authentification');
Route::get('logout', [AuthController::class, 'deconnexion'])->name('deconnexion');

