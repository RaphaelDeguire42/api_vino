<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CellierController;
use App\Http\Controllers\BouteilleController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/index', function () {
    return view('user.index');
})->name("index");


Route::get('creation', [UserController::class, 'creationCompte']);
Route::post('creation', [UserController::class, 'store'])->name('compte.creation');
Route::get('crawler', [AdminController::class, 'dataCrawl']);
Route::get('login', [AuthController::class, 'index'])->name('connexion');
Route::get('logout', [AuthController::class, 'deconnexion'])->name('deconnexion');
Route::post('authentification', [AuthController::class, 'authentification'])->name('authentification');


Route::get('catalogue', [BouteilleController::class, 'index'])->name('bouteille.index');
Route::get('bouteille/{bouteille}', [BouteilleController::class, 'show'])->name('bouteille.show');
Route::delete('bouteille/{bouteille}', [BouteilleController::class, 'destroy'])->name('bouteille.destroy');


Route::post('signaler-erreur', [AdminController::class, 'nouvelleErreur']);


Route::get('/api/celliers/{id_bouteille}', function ($id_bouteille) {
    $user = Auth::user();
    $celliers = $user->celliers()->select('id', 'nom')->get();
    $celliers = $celliers->map(function ($cellier) use ($id_bouteille) {
        $cellier->id_bouteille = $id_bouteille;
        return $cellier;
    });

    return response()->json($celliers);
});



/* Routes protégés par le auth */
Route::middleware(['auth'])->group(function () {
    Route::get('compte', [UserController::class, 'gestionCompte'])->name('compte.gestion');
    Route::post('compte', [UserController::class, 'modificationCompte'])->name('compte.modification');
    Route::get('ajout-bouteille', [BouteilleController::class, 'ajouteBouteille'])->name('admin.ajouteBouteille');
    Route::post('ajout-bouteille', [AdminController::class, 'dataCrawl']);
    Route::get('{id_user}/cellier', [CellierController::class, 'index'])->where('id_user', '[0-9]+')->middleware('isRightUser')->name('cellier.index');
    Route::post('{id_user}/nouveau-cellier', [CellierController::class, 'store'])->where('id_user', '[0-9]+')->middleware('isRightUser');
    Route::delete('cellier/{cellier}', [CellierController::class, 'destroy'])->where('id_user', '[0-9]+')->name('cellier.destroy');
});
/* 
Route::get('/setup', function () {
    $credentials = [
        'email' => 'admin@admin.com',
        'password' => 'password',
        'id_role' => '1'
    ];

    if (!Auth::attempt($credentials)) {
        $user = new \App\Models\User();

        $user->name = 'Admin';
        $user->email = $credentials['email'];
        $user->id_role = $credentials['id_role'];
        $user->password = Hash::make($credentials['password']);

        $user->save();

        if (Auth::attempt($credentials)) {
            $user = Auth::user()->role == 1;

            $basicToken = $user->createToken('basic-token');

            return [
                'basic' => $basicToken->plainTextToken,
            ];
        }
    }
}); */