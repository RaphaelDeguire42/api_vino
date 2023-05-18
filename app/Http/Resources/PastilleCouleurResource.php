<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PastilleCouleurResource extends JsonResource
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
            'id'            => $this->id,
            'hex_value'     => $this->id_user,
            'nom'           => $this->nom,
        ];
    }
}
