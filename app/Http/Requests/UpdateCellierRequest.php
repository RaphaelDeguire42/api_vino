<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateCellierRequest extends FormRequest
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

        if ($method == 'PUT')
        {
            return [
            'id_user'       => ['required'],
            'nom'           => ['required'],
            'id_couleur'    => ['required'],
            ];
        }else{
            return [
                'id_user'       => ['sometimes','required'],
                'nom'           => ['sometimes','required'],
                'id_couleur'    => ['sometimes','required'],
            ];
        }
    }
}
