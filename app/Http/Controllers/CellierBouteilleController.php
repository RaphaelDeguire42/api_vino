<?php

namespace App\Http\Controllers;

use App\Models\Cellier_Bouteille;
use App\Models\Bouteille;
use App\Services\CellierBouteilleQuery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateCellierBouteilleRequest;
use App\Models\Format;
use App\Models\Pays;
use App\Models\Type;

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
        $cellier_bouteille->nom = $request['nom'];
        $cellier_bouteille->quantite = $request['quantite'];
        $cellier_bouteille->date_achat = Carbon::parse($request['date_achat'])->format('Y-m-d H:i:s');
        $cellier_bouteille->garde = $request['garde'];
        $cellier_bouteille->millesime = $request['millesime'];
        $format = Format::firstOrCreate(['format' => $request['format']]);
        $pays = Pays::firstOrCreate(['pays' => $request['pays']]);
        $type = Type::firstOrCreate(['type' => $request['type']]);
        $cellier_bouteille->id_format = $format->id;
        $cellier_bouteille->id_pays = $pays->id;
        $cellier_bouteille->id_type = $type->id;


        $existingBottle = Cellier_Bouteille::where('nom', $request['nom'])
        ->where('millesime', $request['millesime'])
        ->where('id_cellier', $request['id_cellier'])
        ->first();

        if ($existingBottle) {
            $existingBottle->quantite += $request['quantite'];
            $existingBottle->save();

            return response()->json(['message' => 'Cette bouteille existe déjà dans votre cellier. La quantité a été ajustée.']);
        }

        if (!$request->has('id_bouteille') || $request->input('id_bouteille') === null) {
            $bouteille = new Bouteille();
            $bouteille->nom = $request['nom'];
            $bouteille->code_saq = "";
            $bouteille->url_img = "";
            $bouteille->url_saq = "";
            $bouteille->prix = 0;
            $bouteille->actif = false;
            $format = Format::firstOrCreate(['format' => $request['format']]);
            $pays = Pays::firstOrCreate(['pays' => $request['pays']]);
            $type = Type::firstOrCreate(['type' => $request['type']]);
            $bouteille->id_format = $format->id;
            $bouteille->id_pays = $pays->id;
            $bouteille->id_type = $type->id;
            $bouteille->save();
            $cellier_bouteille->id_bouteille = $bouteille->id;
        } else {
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
    public function show(Cellier_Bouteille $cellierBouteille)
    {
        try
        {
            return response()->json($cellierBouteille);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Je ne trouve pas cette bouteille', 'error' => $e->getMessage()], 500);
        }
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
    public function update(UpdateCellierBouteilleRequest $request, Cellier_Bouteille $cellierBouteille)
    {

        try {
            $date = Carbon::parse($request->input('date_achat'))->toDateTimeString();

            $cellierBouteille->date_achat = $date;
            $cellierBouteille->update($request->except('date_achat'));

            return response()->json(['id' => $cellierBouteille->id, 'message' => 'Bouteille modifiée']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'La modification a échoué', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cellier_Bouteille $cellierBouteille)
    {
        try {

            $cellierBouteille->delete();

            return response()->json(['message' => 'La bouteille de ce cellier a été supprimé avec succès']);
        } catch (\Exception $e)
        {
            return response()->json(['message' => 'La suppression n\'a pas fonctionné', 'error' => $e->getMessage()], 500);
        }
    }
}
