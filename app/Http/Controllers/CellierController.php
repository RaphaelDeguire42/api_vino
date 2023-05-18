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

        $celliers = Cellier::join('pastille_couleurs', 'celliers.id_couleur', '=', 'pastille_couleurs.id')
            ->select('celliers.*', 'pastille_couleurs.hex_value')
            ->where($paramQuery)
            ->get();

        return $celliers;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  /*   public function show(Request $request)
    {
        $userId = $request->input('id_user');
        var_dump($request);
        $celliers = Cellier::where('id_user', $userId)->get();

        return response()->json($celliers);
    } */

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
    public function update(Request $request, Cellier $cellier)
    {
        //
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
