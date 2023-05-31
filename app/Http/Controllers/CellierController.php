<?php

namespace App\Http\Controllers;

use App\Models\Cellier;
use App\Models\Pastille_couleur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CellierQuery;
use Illuminate\Http\Response;
use App\Http\Resources\CellierResource;
use App\Http\Resources\CellierCollection;

class CellierController extends Controller
{

    /**
     * Affiche la ressource spécifiée.
     *
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $filtre = new CellierQuery();
            $paramQuery = $filtre->transform($request); // [['column', 'operator', 'value']]

            $celliers = Cellier::query();

            // Appliquer les filtres à la requête
            foreach ($paramQuery as $filter) {
                $celliers->where($filter[0], $filter[1], $filter[2]);
            }

            $incluBouteilles = $request->query('incluBouteilles');
            if ($incluBouteilles) {
                $celliers->with('cellierBouteilles');
            }

            $celliers = $celliers->with('couleur')->get();

            return CellierResource::collection($celliers);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * Affiche une liste des ressources.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Cellier $cellier, Request $request)
    {
        try {
            $incluBouteilles = $request->query('incluBouteilles');
            if ($incluBouteilles) {
                return new CellierResource($cellier->loadMissing('couleur', 'cellierBouteilles'));
            }
            return new CellierResource($cellier->loadMissing('couleur'));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
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
     * Enregistre une nouvelle ressource nouvellement créée dans le stockage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $cellier = new Cellier();
            $cellier->nom = $request->nom;
            $cellier->id_couleur = $request->id_couleur;
            $cellier->id_user = $request->id_user;
            $cellier->save();

            return response()->json(['status' => 'success', 'id' => $cellier->id], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * Affiche le formulaire de modification de la ressource spécifiée.
     *
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function edit(Cellier $cellier)
    {
        //
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCellierRequest $request, Cellier $cellier)
    {
        try {
            $cellier->update($request->all());

            return response()->json(['id' => $cellier->id, 'message' => 'Cellier modifiée']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'La modification a échoué', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     *
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cellier $cellier)
    {
        try {
            $cellier->delete();
            return response()->json(['message' => 'Cellier supprimé']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'La suppression a échoué', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
