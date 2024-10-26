<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AssignedTask extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'assigned_tasks';

    protected $appends = [
        'requirement',
        'proof_of_work',
    ];

    protected $dates = [
        'target_date',
        'completed_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'task_id',
        'sub_task_id',
        'department_id',
        'assigned_to_id',
        'dependence',
        'company_id',
        'customer_id',
        'model_type',
        'model_id',
        'user_id',
        'description',
        'hours_estimation',
        'status_id',
        'is_approved',
        'target_date',
        'completed_date',
        'created_at',
        'updated_at',
        'deleted_at',
        'customer_request_status',
        'customer_id',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function sub_task()
    {
        return $this->belongsTo(SubTask::class, 'sub_task_id');
    }

    public function assigned_to()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRequirementAttribute()
    {
        return $this->getMedia('requirement');
    }

    public function getProofOfWorkAttribute()
    {
        return $this->getMedia('proof_of_work');
    }

    public function assignedTaskAssignedSubTasks()
    {
        return $this->hasMany(AssignedSubTask::class, 'assigned_task_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function getTargetDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTargetDateAttribute($value)
    {
        $this->attributes['target_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getCompletedDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCompletedDateAttribute($value)
    {
        $this->attributes['completed_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function assignedTaskDetails()
    {
        return $this->hasMany(AssignedTaskDetail::class, 'assigned_task_id', 'id');
    }

    public function assigned_sub_tasks()
    {
        return $this->hasMany(AssignedSubTask::class, 'assigned_task_id');
    }

}
