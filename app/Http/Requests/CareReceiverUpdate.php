<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CareReceiverRequest extends FormRequest
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
            'post_code' => 'required|size:7',
            'address' => 'required|max:255',
            'insurer_number' => 'required|min:6|max:8',
            'insured_number' => 'required|size:11',
            'care_level_id' => 'required|numeric|between:1,7',
            'key_person_id' => 'required|numeric',
        ];
    }
}
