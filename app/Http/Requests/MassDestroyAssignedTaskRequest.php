<?php

namespace App\Http\Requests;

use App\Models\AssignedTask;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAssignedTaskRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('assigned_task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:assigned_tasks,id',
        ];
    }
}
