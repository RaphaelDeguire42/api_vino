<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{

     /* 
    * Page création compte
    * Page Gestion compte
    * Modification compte
    */

    public function gestionCompte()
    {
        return view('user.compte');
    }

    public function creationCompte(Request $request)
    {
        return view('user.creation');
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
