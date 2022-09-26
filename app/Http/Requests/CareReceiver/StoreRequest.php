<?php

namespace App\Http\Requests\CareReceiver;

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
            'gender' => 'required',
            'birthday' => 'required|date',
            'post_code' => 'required|size:7',
            'address' => 'required|max:255',
            'insurer_number' => 'required|min:6|max:8',
            'insured_number' => 'required|size:11',
            'care_level_id' => 'required|numeric|between:1,7',
            'keyperson_name' => 'required|string|max:255',
            'keyperson_name_furigana' => 'required|string|max:255',
            'relationship' => 'required|string|max:255',
            'email' => 'required|email|unique:care_receivers|max:255',
            'tel' => 'required|between:10,11|regex:/^0[0-9]{10,11}$/',
            'password' => 'required|between:8,64|confirmed|regex:/^[a-zA-Z0-9]+$/'
        ];
    }
}
