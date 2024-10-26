<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignedTaskDetail extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'assigned_task_details';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'task_id',
        'assigned_task_id',
        'date',
        'start_time',
        'end_time',
        'status_id',
        'is_approved',
        'user_id',
        'company_id',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function assigned_task()
    {
        return $this->belongsTo(AssignedTask::class, 'assigned_task_id');
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

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
