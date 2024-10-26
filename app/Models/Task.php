<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Task extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public const FREQUENCY_SELECT = [
        'DAILY'       => 'daily',
        'WEEKLY'      => 'weekly',
        'MONTHLY'     => 'monthly',
        'QUATERLY'    => 'quaterly',
        'HALF_YEARLY' => 'half yearly',
        'YEARLY'      => 'yearly',
        'EVENT'       => 'event based',
    ];

    public $table = 'tasks';

    protected $appends = [
        'attachment',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'department_id',
        'name',
        'description',
        'frequency',
        'created_at',
        'updated_at',
        'deleted_at',
        'funcation_id',
        'due_date'

    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function taskSubTasks()
    {
        return $this->hasMany(SubTask::class, 'task_id', 'id');
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function departmentFuncation()
    {
        return $this->belongsTo(DepartmentFuncation::class, 'funcation_id');
    }

    public function tags()
    {
        return $this->belongsToMany(TaskTag::class);
    }

    public function getAttachmentAttribute()
    {
        return $this->getMedia('attachment')->last();
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
