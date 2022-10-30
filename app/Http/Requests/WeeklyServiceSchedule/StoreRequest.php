<?php

namespace App\Http\Requests\WeeklyServiceSchedule;

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
            'care_receiver_id' => 'required|integer',
            'nursing_care_office_id' => 'required|integer',
            'dayofweek' => 'required|integer|between:0,6',
            'starting_time' => 'required|date_format:H:i',
            'ending_time' => 'required|date_format:H:i|after:starting_time',
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
