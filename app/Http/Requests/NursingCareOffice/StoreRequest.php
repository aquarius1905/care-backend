<?php

namespace App\Http\Requests\NursingCareOffice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

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
            'office_name' => 'required|string|max:255',
            'corporate_name' => 'required|string|max:255',
            'service_type_id' => 'required|numeric',
            'office_number' => 'required|size:10',
            'post_code' => 'required|size:7',
            'address' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'name_furigana' => 'required|string|max:255',
            'email' => 'required|email|unique:nursing_care_offices',
            'tel' => 'required|between:10,11|regex:/^0[0-9]{10,11}$/',
            'password' => 'required|between:8,64|confirmed|regex:/^[a-zA-Z0-9]+$/',
        ];
    }

    /**
     * バリデーションエラーが起きたら実行される
     *
     * @param Validator $validator
     * @return HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => 'validation error',
            'errors' => $validator->errors()->toArray()
        ], 400);

        throw new HttpResponseException($response);
    }
}
