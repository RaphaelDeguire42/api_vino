<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\Cellier;


class AuthController extends Controller
{
    /* Connexion page 
    *  Connexion compte
    *  Deconnexion compte
    */

    public function login(LoginUserRequest $request) {

        $request->validated($request->all());

        if(!Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return response()->json(['message' => 'Credentials do not match']);
        }

        $user = User::where('email', $request->email)->first();
        $user->tokens()->delete();
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('Api Token of ' . $user->name)->plainTextToken
        ]);
    }

    public function register(RegisterUserRequest $request) {

        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_role' => $request->id_role ?? 2,
        ]);
        
        $cellier = new Cellier();
        $cellier->nom = 'Mon premier cellier';
        $cellier->id_user = $user->id;
        $cellier->id_couleur = 1;
        $cellier->save();


    }

    public function logout() {
        
        return response()->json('This is my logout method');
    }

}
