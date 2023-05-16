<?php

namespace App\Http\Controllers;

use App\Models\Cellier;
use App\Models\Pastille_couleur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CellierQuery;




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

        Cellier::where([['column', 'operator', 'value']]);


            return Cellier::where($paramQuery)->get();
        

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
        $cellier = new Cellier();
        $cellier->nom = $request->nom;
        $cellier->id_couleur = $request->id_couleur;
        $cellier->id_user = Auth::user()->id;
        $cellier->save();

        return redirect()->route('cellier.index', Auth::user()->id);

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
