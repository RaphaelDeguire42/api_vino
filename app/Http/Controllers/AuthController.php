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

    /* 
    * Page Gestion compte
    * Modification compte
    */

    public function gestionCompte()
    {
        return view('auth.compte');
    }

    public function modificationCompte(Request $request)
    {

        $user = Auth::user();

        if (!Hash::check($request->input('ancien_password'), $user->password)) {
            return redirect()->back()->withErrors(['ancien_password' => 'Le mot de passe est incorrect']);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'nouveau_password' => 'nullable|string|min:8',
        ]);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
    
        if ($validatedData['nouveau_password']) {
            $user->password = Hash::make($validatedData['nouveau_password']);
        }
    
        $user->save();
    
    return redirect()->back()->with('success', 'Les informations du compte ont été mises à jour.');
    }



}
