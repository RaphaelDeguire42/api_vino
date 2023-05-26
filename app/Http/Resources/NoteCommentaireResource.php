<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteCommentaireResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $this->load(['bouteille_note_commentaire', 'user_note_commentaire']);
        
        return [
            'id'                    => $this->id,
            'user_nom'              => $this->nom,
            'id_bouteille'          => $this->bouteillesDansCellier_bouteilles->url_img,
            'note'                  => $this->bouteillesDansCellier_bouteilles->url_saq,
            'commentaire'           => $this->bouteillesDansCellier_bouteilles->prix,
        ];
    }
}
