<?php

namespace App\Http\Requests;

use App\Models\Task;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTaskRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('task_create');
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
        ];
    }
}
