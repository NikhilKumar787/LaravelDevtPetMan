<?php

namespace App\Http\Requests;

use App\Models\SubTask;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSubTaskRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sub_task_create');
    }

    public function rules()
    {
        return [
            'department_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'tags.*' => [
                'integer',
            ],
            'tags' => [
                'array',
            ],
            'frequency' => [
                'required',
            ],
            'due_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'task_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
