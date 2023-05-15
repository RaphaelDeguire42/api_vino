<?php

namespace App\Http\Controllers;

use App\Models\Bouteille;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBouteilleRequest;
use App\Http\Requests\UpdateBouteilleRequest;

class BouteilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Bouteille::all();
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
            $bouteille = new Bouteille();
            $bouteille->nom = $produit['nom'];
            $bouteille->code_saq = $produit['code_saq'];
            $bouteille->url_saq = $produit['url'];
            $bouteille->url_img = $produit['img'];
            $bouteille->prix = $produit['prix'];
            $bouteille->id_format = $format->id;
            $bouteille->id_pays = $pays->id;
            $bouteille->id_type = $type->id;
            $bouteille->save();
        return response()->json(['id' => $bouteille->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function show(Bouteille $bouteille)
    {
        return $bouteille;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function edit(Bouteille $bouteille)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBouteilleRequest $request, Bouteille $bouteille)
    {
        $bouteille->update($request->all());
        return response()->json(['id' => $bouteille->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bouteille $bouteille)
    {
        $bouteille->delete();
    }

}
