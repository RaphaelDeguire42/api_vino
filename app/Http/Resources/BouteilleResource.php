<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BouteilleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->load(['pays', 'type', 'format', 'noteCommentaire']);


        return [
            'id'                    => $this->id,
            'nom'                   => $this->nom,
            'code_saq'              => $this->code_saq,
            'url_img'               => $this->url_img,
            'url_saq'               => $this->url_saq,
            'prix'                  => $this->prix,
            'actif'                 => $this->actif,
            'type'                  => $this->type->type,
            'pays'                  => $this->pays->pays,
            'format'                => $this->format->format,
            'note_commentaires'     => NoteCommentaireResource::collection($this->whenLoaded('noteCommentaire'))

        ];
    }
}
