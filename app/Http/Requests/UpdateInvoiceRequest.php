<?php

namespace App\Http\Requests;

use App\Models\Invoice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInvoiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('invoice_edit');
    }

    public function rules()
    {
        return [
            'type' => [
                'required',
            ],
            'invoice_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'invoice_no' => [
                'string',
                'required',
            ],
            'due_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'discount_amount' => [
                'string',
                'nullable',
            ],
        ];
    }
}
