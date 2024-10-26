<?php

namespace App\Http\Requests;

use App\Models\Vendor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVendorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vendor_edit');
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
            'company_name' => [
                'string',
                'required',
            ],
            'gst_type' => [
                'required',
            ],
            'gstin' => [
                'string',
                'nullable',
            ],
            'pin_code' => [
                'string',
                'nullable',
            ],
            'mobile' => [
                'string',
                'min:10',
                'max:13',
                'nullable',
            ],
            'pancard' => [
                'string',
                'nullable',
            ],
            'other' => [
                'string',
                'nullable',
            ],
            'website' => [
                'string',
                'nullable',
            ],
            'payment_method' => [
                'string',
                'nullable',
            ],
            'account_no' => [
                'string',
                'nullable',
            ],
            'tax_reg_no' => [
                'string',
                'nullable',
            ],
            'effective_date' => [
                'string',
                'nullable',
            ],
        ];
    }
}
