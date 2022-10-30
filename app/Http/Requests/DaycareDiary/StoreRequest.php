<?php

namespace App\Http\Requests\DaycareDiary;

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
            'weekly_service_schedule_id' => 'required|integer|min:1',
            'date' => 'required|date',
            'situation_at_home' => 'nullable|string|max:255',
            'body_temperature' => 'required|numeric|between:30,40',
            'systonic_blood_pressure' => 'required|integer|between:0,999',
            'diastolic_blood_pressure' => 'required|integer|between:0,999',
            'pulse' => 'required|integer|between:0,150',
            'staple_food' => 'required|integer|between:0,10',
            'side_dish' => 'required|integer|between:0,10',
            'recreation' => 'required|boolean',
            'rehabilitations' => 'required|array',
            'others_detail' => 'nullable|string|max:255',
            'special_notes' => 'nullable|string|max:255',
            'entry_person' => 'required|string|max:255'
        ];
    }
}
