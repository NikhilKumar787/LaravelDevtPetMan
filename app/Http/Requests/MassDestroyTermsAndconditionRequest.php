<?php

namespace App\Http\Requests;

use App\Models\TermsAndcondition;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTermsAndconditionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('terms_andcondition_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:terms_andconditions,id',
        ];
    }
}
