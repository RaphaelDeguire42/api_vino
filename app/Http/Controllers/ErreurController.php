<?php

namespace App\Http\Controllers;

use App\Models\Erreur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ErreurController extends Controller
{
    /**
     * Affiche une liste des ressources.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $erreurs = Erreur::with('user')->get();

            $formattedErreurs = $erreurs->map(function ($erreur) {
                $nomUser = $erreur->user ? $erreur->user->name : null;
                $erreur->setAttribute('nom_user', $nomUser);
                unset($erreur->user);
                return $erreur;
            });

            return response()->json($formattedErreurs);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur s\'est produite', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * Affiche le formulaire de création d'une nouvelle ressource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Stocke une nouvelle ressource dans le stockage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $erreur = new Erreur();
            $erreur->erreur = $request->erreur;
            $erreur->id_user = $request->id_user;
            $erreur->save();

            return response()->json(['message' => 'Erreur enregistrée'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur s\'est produite', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Affiche la ressource spécifiée.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Affiche le formulaire de modification de la ressource spécifiée.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Code to update the specified resource
        } catch (\Exception $e) {
            return response()->json(['message' => 'La mise à jour a échoué', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $erreur = Erreur::findOrFail($id);
            $erreur->delete();

            return response()->json(['message' => 'Erreur supprimée']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'La suppression a échoué', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
