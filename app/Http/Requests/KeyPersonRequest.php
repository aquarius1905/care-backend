<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeyPersonRequest extends FormRequest
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
            'name' => 'required|max:255',
            'name_furigana' => 'required|max:255',
            'relationship' => 'required',
            'email' => 'required|email|unique:key_persons|max:255',
            'tel' => 'required|between:10,11',
            'password' => 'required|min:12|regex:/^[a-zA-Z0-9]+$/',
            'care_receiver_id' => 'required|numeric'
        ];
    }
}
