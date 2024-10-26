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

class SubTask extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
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

    public const PRIORITY_SELECT = [
        '1'       => 'First',
        '2'      => 'Second',
        '3'       => 'Third',
        '4'      => 'Fourth',
        '5'      => 'Fiveth', 
    ];

    public $table = 'sub_tasks';

    protected $appends = [
        'attachment',
    ];

    protected $dates = [
        'due_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'department_id',
        'name',
        'description',
        'frequency',
        'due_date',
        'task_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
        'company_id',
        'assigned_id',
        'dependence',
        'created_by_id',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function tags()
    {
        return $this->belongsToMany(TaskTag::class);
    }

    public function getAttachmentAttribute()
    {
        return $this->getMedia('attachment')->last();
    }

    public function getDueDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class , 'company_id');
    }
    
    public function assigned_employee()
    {
        return $this->belongsTo(User::class, 'assigned_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
