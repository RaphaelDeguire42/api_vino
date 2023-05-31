<?php

namespace App\Http\Controllers;

use App\Models\Cellier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /*
    * Page création compte
    * Page Gestion compte
    * Modification compte
    */

    public function index()
    {
        try {
            $users = User::all();
            return new UserCollection($users);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur s\'est produite durant la requête'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create(Request $request)
    {
        //
    }

    public function show(Request $request, User $user)
    {
        try {
            $incluCelliers = $request->query('incluCelliers');
            $incluBouteilles = $request->query('incluBouteilles');

            if ($incluCelliers) {
                return new UserResource($user->loadMissing('celliers'));
            }

            return new UserResource($user);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur s\'est produite durant la requête'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8', // TODO remettre les validations dans une request
        ]);

        try {
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
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur s\'est produite lors de la création du compte.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'nouveau_password' => 'nullable|string|min:8',
        ]);

        try {
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];

            if ($validatedData['nouveau_password']) {
                $user->password = Hash::make($validatedData['nouveau_password']);
            }

            $user->save();

            return response()->json(['message' => 'Les informations du compte ont été mises à jour.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur s\'est produite lors de la mise à jour du compte.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $user->celliers()->delete();

            $user->delete();

            return response()->json(['message' => 'Utilisateur supprimé avec succès']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur s\'est produite lors de la suppression de l\'utilisateur.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
