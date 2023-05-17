<?php

namespace App\Http\Controllers;

use App\Models\Cellier_Bouteille;
use App\Models\Bouteille;
use App\Services\CellierBouteilleQuery;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CellierBouteilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filtre = new CellierBouteilleQuery();
        $paramQuery = $filtre->transform($request); // [['column', 'operator', 'value']]

        Cellier_Bouteille::where([['column', 'operator', 'value']]);

        if (count($paramQuery) === 0){
            return Cellier_Bouteille::all();
        } else {
            return Cellier_Bouteille::where($paramQuery)->get();
        }
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
        $cellier_bouteille = new Cellier_Bouteille();
        $cellier_bouteille->id_bouteille = $request->has('id_bouteille') ? $request['id_bouteille'] : null;
        $cellier_bouteille->id_cellier = $request['id_cellier'];
        $cellier_bouteille->quantite = $request['quantite'];
        $cellier_bouteille->date_achat = Carbon::parse($request['date_achat'])->format('Y-m-d H:i:s');
        $cellier_bouteille->garde = $request['garde'];
        $cellier_bouteille->millesime = $request['millesime'];

        if ($request->has('id_bouteille')) {
            $bouteille = Bouteille::find($request['id_bouteille']);
            if ($bouteille) {
                // Fill missing data with bouteille data
                $cellier_bouteille->nom = $bouteille->nom;
                $cellier_bouteille->id_pays = $bouteille->id_pays;
                $cellier_bouteille->url_img = $bouteille->url_img;
            }
        }

        $cellier_bouteille->save();

        return response()->json(['id' => $cellier_bouteille->id]);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
