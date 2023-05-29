<?php

namespace App\Http\Controllers;

use App\Models\Note_Commentaire;
use Illuminate\Http\Request;

class NoteCommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $note_Commentaires = Note_Commentaire::all();

        return response()->json($note_Commentaires, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_bouteille' => 'required|integer',
            'id_user'       => 'required|integer',
            'note' => 'required|sometimes|integer',
            'commentaire' => 'required|sometimes|string',
        ]);

        
        $existingRecord = Note_Commentaire::where('id_user', $data['id_user'])
        ->where('id_bouteille', $data['id_bouteille'])
        ->first();


        if ($existingRecord) {
            $existingRecord->update($data);
            return response()->json($existingRecord, 200);
        }


        $note_Commentaire = Note_Commentaire::create($data);

        return response()->json($note_Commentaire, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note_Commentaire  $note_Commentaire
     * @return \Illuminate\Http\Response
     */
    public function show(Note_Commentaire $note_Commentaire)
    {
        return response()->json($note_Commentaire, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note_Commentaire  $note_Commentaire
     * @return \Illuminate\Http\Response
     */
   
    public function update(Request $request, Note_Commentaire $note_Commentaire)
    {
        $data = $request->validate([
            'note' => 'required|sometimes|integer',
            'commentaire' => 'required|sometimes|string',
            'id_bouteille' => 'required|sometimes|integer'
        ]);

        $note_Commentaire->update($data);

        return response()->json($note_Commentaire, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note_Commentaire  $note_Commentaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note_Commentaire $note_Commentaire)
    {
        $note_Commentaire->delete();

        return response()->json(null, 204);
    }
}
