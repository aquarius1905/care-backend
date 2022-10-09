<?php

namespace App\Http\Requests\CareManager;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'name_furigana' => 'required|string|max:255',
            'registration_number' => 'required|string|size:8',
            'email' => 'required|email|unique:care_managers|max:255',
            'tel' => 'required|string|between:10,11',
            'password' => 'required|between:8,64|confirmed|regex:/^[a-zA-Z0-9]+$/',
            'office_name' => 'required|string|max:255',
            'corporate_name' => 'required|string|max:255',
            'office_number' => 'required|string|size:10',
            'office_postcode' => 'required|string|size:7',
            'office_address' => 'required|string|max:255',
        ];
    }
}
