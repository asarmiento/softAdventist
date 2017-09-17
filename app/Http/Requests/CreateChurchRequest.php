<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateChurchRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return ['name' => 'required|unique:churches,name', 'local_field_id' => 'required','localizacion'=>'required'];
    }

    public function attributes()
    {
        return ['name' => 'Nombre de tu Iglesia', 'local_field_id' => 'El Campo Local'];
    }
}
