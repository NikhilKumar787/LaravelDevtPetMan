<?php

namespace App\Http\Requests;

use App\Models\AssignedTaskDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAssignedSubTaskDetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('assigned_sub_task_detail_edit');
    }

    public function rules()
    {
        return [
            'assigned_sub_task_id' => [
                'required',
                'integer',
            ],
            'date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'start_time' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'end_time' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
