<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'departments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'department_head_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function departmentTasks()
    {
        return $this->hasMany(Task::class, 'department_id', 'id');
    }

    public function departmentHeads(){
        return $this->hasMany(DepartmentHead::class, 'id');
    }

    public function department_head()
    {
        return $this->belongsTo(User::class, 'department_head_id');
    }

    public function department_head_d_id()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
