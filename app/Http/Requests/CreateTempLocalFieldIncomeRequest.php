<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTempLocalFieldIncomeRequest extends FormRequest
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
        return [
            'balance'=>'required',
            'church_l_f_income_account_id'=>'required'
        ];
    }

    public function attributes()
    {
        return [
            'balance'=>'Monto',
            'church_l_f_income_account_id'=>'Cuenta Campo local'
        ];
    }
}
