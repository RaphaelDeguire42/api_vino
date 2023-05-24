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
     * Display the specified resource.
     *
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $filtre = new CellierQuery();
    $paramQuery = $filtre->transform($request); // [['column', 'operator', 'value']]

    $celliers = Cellier::query();

    // Apply the filters to the query
    foreach ($paramQuery as $filter) {
        $celliers->where($filter[0], $filter[1], $filter[2]);
    }

    $incluBouteilles = $request->query('incluBouteilles');
    if ($incluBouteilles) {
        $celliers->with('cellierBouteilles');
    }

    $celliers = $celliers->with('couleur')->get();

    return CellierResource::collection($celliers);
}

/* 
    public function index(Request $request)
    {
        $filtre = new CellierQuery();
        $paramQuery = $filtre->transform($request); // [['column', 'operator', 'value']]

        $celliers = Cellier::query($paramQuery);
    

        $incluBouteilles = $request->query('incluBouteilles');
        if ($incluBouteilles) {
            $celliers->with('cellierBouteilles');
        }
    
        $celliers = $celliers->with('couleur')->get();
    
        return CellierResource::collection($celliers);
        
        $celliers = Cellier::join('pastille_couleurs', 'celliers.id_couleur', '=', 'pastille_couleurs.id')
            ->select('celliers.*', 'pastille_couleurs.hex_value')
            ->where($paramQuery)
            ->get();

        return $celliers; 
    } */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function show(Cellier $cellier, Request $request)
    {
        $incluBouteilles = $request->query('incluBouteilles');
        if ($incluBouteilles)
        {
            return new CellierResource($cellier->loadMissing('couleur', 'cellierBouteilles'));
        }
        return new CellierResource($cellier->loadMissing('couleur'));
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
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
            // Temporaire car pas encore de user
            $cellier->id_user = 1;
            //$cellier->id_user = Auth::user()->id;
            $cellier->save();

            return response()->json(['status' => 'success', 'id' => $cellier->id], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function edit(Cellier $cellier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
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
        } catch (\Exception $e) 
        {
            return response()->json(['message' => 'La modification a échoué', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cellier $cellier)
    {
        $cellier->delete();
    }
}
