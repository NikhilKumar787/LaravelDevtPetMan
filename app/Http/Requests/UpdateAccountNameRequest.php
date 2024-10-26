<?php

namespace App\Http\Requests;

use App\Models\AccountName;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAccountNameRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('account_name_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'account_type_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
