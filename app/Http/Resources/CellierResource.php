<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PastilleCouleurResource;


class CellierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'id_user'               => $this->id_user,
            'nom'                   => $this->nom,
            'id_couleur'            => $this->id_couleur,
            'hex_value'             => $this->cellierHasCouleur->hex_value,
            'bouteillesDuCellier'   => $this->cellierBouteilles
        ];
    }
}
