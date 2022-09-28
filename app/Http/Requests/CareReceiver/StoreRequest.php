<?php

namespace App\Http\Requests\CareReceiver;

use App\Rules\InsurerNumberRule;
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
            'gender' => 'required|boolean',
            'birthday' => 'required|date',
            'post_code' => 'required|string|size:7',
            'address' => 'required|string|max:255',
            'insurer_number' => ['required', new InsurerNumberRule()],
            'insured_number' => 'required|size:10',
            'care_level_id' => 'required|numeric|between:1,7',
            'keyperson_name' => 'required|string|max:255',
            'keyperson_name_furigana' => 'required|string|max:255',
            'relationship' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tel' => 'required|between:10,11|regex:/^0[0-9]{10,11}$/',
            'password' => 'required|between:8,64|confirmed|regex:/^[a-zA-Z0-9]+$/'
        ];
    }
}
