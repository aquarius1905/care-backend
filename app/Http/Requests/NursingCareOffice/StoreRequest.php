<?php

namespace App\Http\Requests\NursingCareOffice;

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
            'company_name' => 'required|string',
            'company_zip' => 'required|digits:7',
            'company_addr1' => 'required|string',
            'company_url' => 'nullable|url',
            'industry_id' => 'required|digits_between:2,4',
            'market_id' => 'required|digits_between:1,2',
            'sales_id' => 'required|digits:2',
            'employee_id' => 'required|digits:2',
            'name' => 'required|string',
            'department' => 'required|string',
            'email' => 'required|unique:companies|email:rfc,dns',
            'tel' => 'nullable|regex:/^0[-0-9]{9,12}$/',
            'password' => 'required|min:12|confirmed',
        ];
    }
}
