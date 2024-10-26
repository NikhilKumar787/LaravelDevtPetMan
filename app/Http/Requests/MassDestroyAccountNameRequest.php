<?php

namespace App\Http\Requests;

use App\Models\AccountName;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAccountNameRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('account_name_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:account_names,id',
        ];
    }
}
