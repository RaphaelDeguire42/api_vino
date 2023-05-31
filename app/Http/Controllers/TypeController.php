<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Resources\TypeResource;
use Illuminate\Http\Response;

class TypeController extends Controller
{
    /**
     * Affiche une liste des ressources.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $types = Type::whereDoesntHave('bouteille', function ($query) {
                $query->where('actif', 0);
            })->get();

            return TypeResource::collection($types);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de la récupération des ressources'], Response::HTTP_INTERNAL_SERVER_ERROR);
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
     * Stocke une nouvelle ressource nouvellement créée.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Affiche la ressource spécifiée.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $type = Type::find($id);

            if (!$type) {
                return response()->json(['error' => 'Type introuvable'], 404);
            }

            return response()->json($type);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de la récupération de la ressource'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Affiche le formulaire d'édition de la ressource spécifiée.
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
        //
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
            // Fetch la resource
            $type = Type::findOrFail($id);

            // Delete la resource
            $type->delete();

            return response()->json(['message' => 'Ressource supprimée']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'La suppression a échoué', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
