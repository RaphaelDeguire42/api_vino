<?php

namespace App\Http\Controllers;

use App\Models\Bouteille;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBouteilleRequest;
use App\Http\Requests\UpdateBouteilleRequest;
use App\Http\Resources\BouteilleResource;
use App\Services\BouteilleQuery;

class BouteilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
    public function store(StoreBouteilleRequest $request)
        {
                /*
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
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function show(Bouteille $bouteille)
    {
        $bouteille->load('type.bouteille', 'format.bouteille', 'pays.bouteille');

        $bouteille->makeHidden(['id_type', 'id_format', 'id_pays']);
        $bouteille->pays = $bouteille->pays->pays;
        $bouteille->format = $bouteille->format->format;
        $bouteille->type = $bouteille->type->type;

        $response = [
            'id' => $bouteille->id,
            'nom' => $bouteille->nom,
            'code_saq' => $bouteille->code_saq,
            'url_saq' => $bouteille->url_saq,
            'url_img' => $bouteille->url_img,
            'prix' => $bouteille->prix,
            'actif' => $bouteille->actif,
            'created_at' => $bouteille->created_at,
            'updated_at' => $bouteille->updated_at,
            'pays' => $bouteille->pays,
            'format' => $bouteille->format,
            'type' => $bouteille->type,
        ];

        return $response;
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
        return response()->json(['id' => $bouteille->id]);
    }

}
