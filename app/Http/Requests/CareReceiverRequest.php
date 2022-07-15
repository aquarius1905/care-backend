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
            'birthday' => 'required|date',
            'post_code' => 'required|size:7',
            'address' => 'required|max:255',
            'care_level' => 'required|between:0,6',
        ];
    }
}
