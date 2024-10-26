<?php

namespace App\Http\Requests;

use App\Models\Company;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('company_edit');
    }

    public function rules()
    {
        return [
            'username_for_pan_tan' => [
                'string',
                'nullable',
            ],
            'password_for_pan_tan' => [
                'string',
                'nullable',
            ],
            'username_for_gst_vat_icegate_dgft' => [
                'string',
                'nullable',
            ],
            'password_for_gst_vat_icegate_dgft' => [
                'string',
                'nullable',
            ],
            'username_for_e_way_e_invoicing' => [
                'string',
                'nullable',
            ],
            'password_for_e_way_e_invoicing' => [
                'string',
                'nullable',
            ],
            'username_for_traces' => [
                'string',
                'nullable',
            ],
            'password_for_traces' => [
                'string',
                'nullable',
            ],
            'username_for_pf_esi_and_other_labour_law' => [
                'string',
                'nullable',
            ],
            'password_for_pf_esi_and_other_labour_law' => [
                'string',
                'nullable',
            ],
            'username_for_reporting_portal' => [
                'string',
                'nullable',
            ],
            'password_for_reporting_portal' => [
                'string',
                'nullable',
            ],
            'company_name' => [
                'string',
                'required',
            ],
            'gstin' => [
                'string',
                'nullable',
            ],
            'address_line_1' => [
                'string',
                'nullable',
            ],
            'address_line_2' => [
                'string',
                'nullable',
            ],
        ];
    }
}
