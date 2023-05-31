<?php

namespace App\Http\Controllers;

use App\Models\Bouteille;
use App\Models\Cellier_Bouteille;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreBouteilleRequest;
use App\Http\Requests\UpdateBouteilleRequest;
use App\Http\Resources\BouteilleResource;
use App\Services\BouteilleQuery;

class BouteilleController extends Controller
{
    /**
     * Affiche une collection de ressources.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $filtre = new BouteilleQuery();
            $paramQuery = $filtre->transform($request); // [['column', 'operator', 'value']]
        
            $query = Bouteille::query();
        
            $ordre = $request->query('prix');
        
            foreach ($paramQuery as $param) {
                $query->where($param[0], $param[1], $param[2]);
            }
        
            if ($ordre) {
                $query->orderBy('prix', $ordre);
            }
        
            $bouteilles = $query->get();
            return BouteilleResource::collection($bouteilles);
        } catch (\Exception $e) {
           // Gestion des exceptions
            return response()->json(['message' => 'Une erreur s\'est produite lors de la récupération des bouteilles'], 500);
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
    public function store(StoreBouteilleRequest $request)
    {
             
    }

    /**
     * Affiche la ressource spécifiée.
     *
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function show(Bouteille $bouteille)
    {
        try {
            return new BouteilleResource($bouteille);
        } catch (\Exception $e) {
           // Gestion des exceptions
            return response()->json(['message' => 'Une erreur s\'est produite lors de la récupération de la bouteille'], 500);
        }
    }


    /**
     * Affiche le formulaire pour modifier la ressource spécifiée.
     *
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function edit(Bouteille $bouteille)
    {
        //
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBouteilleRequest $request, Bouteille $bouteille)
    {
        try {
            $bouteille->update($request->all());
            return response()->json(['id' => $bouteille->id]);
        } catch (\Exception $e) {
           // Gestion des exceptions
            return response()->json(['message' => 'Une erreur s\'est produite lors de la mise à jour de la bouteille'], 500);
        }
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     *
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bouteille $bouteille)
    {
        try {
            $bouteille->delete();
            return response()->json(['id' => $bouteille->id]);
        } catch (\Exception $e) {
           // Gestion des exceptions
            return response()->json(['message' => 'Une erreur s\'est produite lors de la suppression de la bouteille'], 500);
        }
    }


    /**
     * Affiche des statistiques sur les ressources.
     *
     * @return \Illuminate\Http\Response
     */
    public function stats()
    {
        try {
            $bouteilleCounts = [
                'decompte_des_types' => Cellier_Bouteille::select('types.type', DB::raw('count(*) as décompte'))
                    ->join('types', 'Cellier__bouteilles.id_type', '=', 'types.id')
                    ->groupBy('types.type')
                    ->get(),
        
                'decompte_des_pays' => Cellier_Bouteille::select('pays.pays', DB::raw('count(*) as décompte'))
                    ->join('pays', 'Cellier__bouteilles.id_pays', '=', 'pays.id')
                    ->groupBy('pays.pays')
                    ->get(),
        
            ];
        
            return response()->json($bouteilleCounts);
        } catch (\Exception $e) {
           // Gestion des exceptions
            return response()->json(['message' => 'Une erreur s\'est produite lors du calcul des décomptes des bouteilles'], 500);
        }
    }


}
