<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'hsn' => [
                'string',
                'nullable',
            ],
            'unit' => [
                'string',
                'nullable',
            ],
            'cess' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'item_code' => [
                'string',
                'nullable',
            ],
            'income_account_type' => [
                'required',
            ],
            'account_group' => [
                'required',
            ],
            'account_type_id' => [
                'required',
                'integer',
            ],
            'account_name_id' => [
                'required',
                'integer',
            ],
            'categories.*' => [
                'integer',
            ],
            'categories' => [
                'required',
            ],
        ];
    }
}
