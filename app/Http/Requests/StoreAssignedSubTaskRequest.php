<?php

namespace App\Http\Requests;

use App\Models\AssignedSubTask;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAssignedSubTaskRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('assigned_sub_task_create');
    }

    public function rules()
    {
        return [
            'task_id' => [
                'required',
                'integer',
            ],
            'assigned_to_id' => [
                'required',
                'integer',
            ],
            'company_id' => [
                'required',
                'integer',
            ],
            'hours_estimation' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'requirement' => [
                'array',
            ],
            'proof_of_work' => [
                'array',
            ],
            'target_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'completed_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'assigned_task_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
