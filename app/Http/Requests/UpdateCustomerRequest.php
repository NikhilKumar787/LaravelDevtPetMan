<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('customer_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
            ],
            'first_name' => [
                'string',
                'required',
            ],
            'middle_name' => [
                'string',
                'nullable',
            ],
            'last_name' => [
                'string',
                'nullable',
            ],
            'gstin' => [
                'string',
                'nullable',
            ],
            'gst_customer_name' => [
                'string',
                'nullable',
            ],
            'mobile' => [
                'string',
                'min:10',
                'max:13',
                'nullable',
            ],
            'pin_code' => [
                'string',
                'nullable',
            ],
            'company' => [
                'string',
                'required',
            ],
            'other' => [
                'string',
                'nullable',
            ],
            'website' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'pan_no' => [
                'string',
                'nullable',
            ],
            'tan' => [
                'string',
                'nullable',
            ],
            'optional_data_1' => [
                'string',
                'nullable',
            ],
            'optional_data_2' => [
                'string',
                'nullable',
            ],
        ];
    }
}
