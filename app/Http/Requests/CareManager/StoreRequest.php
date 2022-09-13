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
            'home_care_support_office_id' => 'required|numeric',
            'name' => 'required|max:255',
            'name_furigana' => 'required|max:255',
            'registration_number' => 'required|size:8',
            'email' => 'required|email|unique:care_managers|max:255',
            'tel' => 'required|between:10,11',
            'password' => 'required|min:12|regex:/^[a-zA-Z0-9]+$/'
        ];
    }
}
