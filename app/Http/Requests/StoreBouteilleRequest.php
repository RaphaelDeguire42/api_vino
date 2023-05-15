<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreBouteilleRequest extends FormRequest
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
            'nom' => ['required'],
            'code_saq' => ['required'],
            'url_saq' => ['required'],
            'url_img' => ['required'],
            'prix' => ['required'],
            'id_format' => ['required'],
            'id_pays' => ['required'],
            'id_type' => ['required'],
        ];
    }
}
