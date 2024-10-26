<?php

namespace App\Http\Requests;

use App\Models\AssignedTaskDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAssignedTaskDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('assigned_task_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:assigned_task_details,id',
        ];
    }
}
