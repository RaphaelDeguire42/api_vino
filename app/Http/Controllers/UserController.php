<?php

namespace App\Http\Controllers;

use App\Models\Cellier;
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

    public function index()
    {
        
    }

    public function create(Request $request)
    {
       //
    }

    public function show(Request $request, User $user)
    {
       
        $incluCelliers = $request->query('incluCelliers')


        return response()->json($user);
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8', // TODO remettre les validations dans une request
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'id_role' => 1,
        ]);

        $cellier = new Cellier();
        $cellier->nom = 'Mon premier cellier';
        $cellier->id_user = $user->id;
        $cellier->id_couleur = 1;
        $cellier->save();

        Auth::login($user);

        return response()->json(['message' => 'Nouveau compte créé avec succès.']);
    }




    public function update(Request $request)
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

        return response()->json(['message' => 'Les informations du compte ont été mises à jour.']);
    }



    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // A checker le auth pour soit un admin soit le proprio du compte

        $user->delete();

        return response()->json(['message' => 'Utilisateur supprimé avec succès']);
    }

}
