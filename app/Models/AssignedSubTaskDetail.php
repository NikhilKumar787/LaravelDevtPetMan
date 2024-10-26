<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignedSubTaskDetail extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'assigned_sub_task_details';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'sub_task_id',
        'assigned_sub_task_id',
        'date',
        'start_time',
        'end_time',
        'status_id',
        'is_approved',
        'user_id',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function sub_task()
    {
        return $this->belongsTo(SubTask::class, 'sub_task_id');
    }

    public function assigned_sub_task()
    {
        return $this->belongsTo(AssignedSubTask::class, 'assigned_sub_task_id');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
