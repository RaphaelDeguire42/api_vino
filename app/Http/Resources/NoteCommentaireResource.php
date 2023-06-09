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
        $this->load(['bouteille_note_commentaire', 'has_user']);
        return [ 
            
            'id'                    => $this->id,
            'user_nom'              => $this->has_user->name,
            'id_bouteille'          => $this->id_bouteille,
            'note'                  => $this->note,
            'commentaire'           => $this->commentaire,
        ];
    }
}
