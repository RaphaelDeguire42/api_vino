<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCellierBouteilleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
            return [
                'id_bouteille'  => ['sometimes','required'],
                'id_cellier'    => ['sometimes','required'],
                'id_pays'       => ['sometimes','required'],
                'nom'           => ['sometimes','required'],
                'url_img'       => ['sometimes','required'],
                'quantite'      => ['sometimes','required'],
                'date_achat'    => ['sometimes','required'],
                'garde'         => ['sometimes','required'],
                'millesime'     => ['sometimes','required'],
            ];
    }
    
}
