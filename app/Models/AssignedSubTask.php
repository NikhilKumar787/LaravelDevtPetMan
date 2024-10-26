<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AssignedSubTask extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'assigned_sub_tasks';

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
        'assigned_to_id',
        'company_id',
        'user_id',
        'description',
        'hours_estimation',
        'status_id',
        'is_approved',
        'target_date',
        'completed_date',
        'created_at',
        'assigned_task_id',
        'updated_at',
        'deleted_at',
        'team_id',
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

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
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

    public function assigned_task()
    {
        return $this->belongsTo(AssignedTask::class, 'assigned_task_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function assignedSubTaskDetails()
    {
        return $this->hasMany(AssignedSubTaskDetail::class, 'assigned_sub_task_id', 'id');
    }
}
