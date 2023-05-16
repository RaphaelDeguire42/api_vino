<?php

namespace App\Http\Controllers;

use App\Models\Cellier_Bouteille;
use Illuminate\Http\Request;

class CellierBouteilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cellier_bouteille::all();
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
        $cellier_bouteille->id_bouteille = $request['id_bouteille'];
        $cellier_bouteille->id_cellier = $request['id_cellier'];
        $cellier_bouteille->quantite = $request['quantite'];
        $cellier_bouteille->date_achat = $request['date_achat'];
        $cellier_bouteille->garde = $request['garde'];
        $cellier_bouteille->millesime = $request['millesime'];
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
