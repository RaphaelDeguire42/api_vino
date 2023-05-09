<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    /* Connexion page 
    *  Connexion compte
    *  Deconnexion compte
    */

    public function index()
    {
        return view('auth.index');
    }

    public function authentification(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

       if(!Auth::validate($credentials)):
            return redirect(route('connexion'))->withErrors('erreur de mot de passe')->withInput();
       endif;

       $user = Auth::getProvider()->retrieveByCredentials($credentials);
     

       Auth::login($user);
       session()->start();
       session()->put('auth', $user->name);

       return redirect()->intended(url('/'));
    }

    public function deconnexion(){
        Auth::logout();
        session()->forget('auth');
        return redirect(route('connexion'));
    }


}
