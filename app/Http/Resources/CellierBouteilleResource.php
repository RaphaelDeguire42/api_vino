<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CellierBouteilleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->load(['bouteillesDansCellier_bouteilles']);

        return [
            'id'                    => $this->id,
            'nom'                   => $this->nom,
            'code_saq'              => $this->bouteillesDansCellier_bouteilles->code_saq,
            'url_saq'               => $this->bouteillesDansCellier_bouteilles->url_saq,
            'url_saq'               => $this->bouteillesDansCellier_bouteilles->url_saq,
            'prix'                  => $this->bouteillesDansCellier_bouteilles->prix,
            'actif'                 => $this->bouteillesDansCellier_bouteilles->actif,
            'id_type'               => $this->bouteillesDansCellier_bouteilles->id_type,
            'id_pays'               => $this->id_pays,
            'id_format'             => $this->bouteillesDansCellier_bouteilles->id_format,
            'quantite'              => $this->quantite,
            'date_achat'            => $this->date_achat,
            'garde'                 => $this->garde,
            'millesime'             => $this->millesime,

        ];
    }
}