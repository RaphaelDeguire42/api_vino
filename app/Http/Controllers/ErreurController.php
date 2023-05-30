<?php

namespace App\Http\Controllers;

use App\Models\Erreur;
use App\Models\User;
use Illuminate\Http\Request;

class ErreurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $erreurs = Erreur::with('user')->get();

        $formattedErreurs = $erreurs->map(function ($erreur) {
            $nomUser = $erreur->user ? $erreur->user->name : null;
            $erreur->setAttribute('nom_user', $nomUser);
            unset($erreur->user);
            return $erreur;
        });

        return response()->json($formattedErreurs);
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
        $erreur = new Erreur();
        $erreur->erreur = $request->erreur;
        $erreur->id_user = $request->id_user;
        $erreur->save();
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
