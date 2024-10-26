<?php

namespace App\Http\Requests;

use App\Models\TermsAndcondition;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTermsAndconditionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('terms_andcondition_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
