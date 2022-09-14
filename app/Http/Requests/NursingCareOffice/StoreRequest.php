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
            'office_name' => 'required|string',
            'corporate_name' => 'required|string',
            'service_type_id' => 'required|numeric',
            'office_number' => 'required|size:10',
            'post_code' => 'required|size:7',
            'address' => 'required|string',
            'name' => 'required|string',
            'name_furigana' => 'required|string',
            'email' => 'required',
            'tel' => 'required|regex:/^0[0-9]{10,11}$/',
            'password' => 'required|min:8|confirmed',
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
