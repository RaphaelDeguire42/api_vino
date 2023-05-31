<?php

namespace App\Http\Controllers;

use App\Models\Note_Commentaire;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NoteCommentaireController extends Controller
{
    /**
     * Affiche une liste des ressources.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $note_Commentaires = Note_Commentaire::all();

            return response()->json($note_Commentaires, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur s\'est produite', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Stocke une nouvelle ressource dans le stockage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'id_bouteille' => 'required|integer',
                'id_user' => 'required|integer',
                'note' => 'sometimes|integer',
                'commentaire' => 'sometimes|string',
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
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur s\'est produite', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Affiche la ressource spécifiée.
     *
     * @param  \App\Models\Note_Commentaire  $note_Commentaire
     * @return \Illuminate\Http\Response
     */
    public function show(Note_Commentaire $note_Commentaire)
    {
        try {
            return response()->json($note_Commentaire, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur s\'est produite', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Met à jour la ressource spécifiée dans le stockage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note_Commentaire  $note_Commentaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note_Commentaire $note_Commentaire)
    {
        try {
            $data = $request->validate([
                'note' => 'required|sometimes|integer',
                'commentaire' => 'required|sometimes|string',
                'id_bouteille' => 'required|sometimes|integer',
            ]);

            $note_Commentaire->update($data);

            return response()->json($note_Commentaire, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'La mise à jour a échoué', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Supprime la ressource spécifiée du stockage.
     *
     * @param  \App\Models\Note_Commentaire  $note_Commentaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note_Commentaire $note_Commentaire)
    {
        try {
            $note_Commentaire->delete();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['message' => 'La suppression a échoué', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
