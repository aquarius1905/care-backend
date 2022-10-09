<?php

namespace App\Http\Requests\NursingCareOffice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'office_name' => 'required|string|max:255',
            'corporate_name' => 'required|string|max:255',
            'service_type_id' => 'required|numeric',
            'office_number' => 'required|string|size:10',
            'post_code' => 'required|string|size:7',
            'address' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'name_furigana' => 'required|string|max:255',
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('nursing_care_offices')->ignore(Auth::id())
            ],
            'tel' => 'required|string|between:10,11|regex:/^0[0-9]{10,11}$/',
            'password' => 'nullable|string|between:8,64|confirmed|regex:/^[a-zA-Z0-9]+$/'
        ];
    }
}
