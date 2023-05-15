<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateBouteilleRequest extends FormRequest
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
        $method = $this->method();
        
        if ($method == 'PUT'){
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
        } else {
            return [
                'nom' => ['sometimes','required'],
                'code_saq' => ['sometimes','required'],
                'url_saq' => ['sometimes','required'],
                'url_img' => ['sometimes','required'],
                'prix' => ['sometimes','required'],
                'id_format' => ['sometimes','required'],
                'id_pays' => ['sometimes','required'],
                'id_type' => ['sometimes','required'],
            ];
        }
       
    }
}
