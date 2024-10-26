<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TaskEmployeeListing extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'task_employee_listing';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'department_id',
        'task_id',
        'company_id',
        'assigned_to_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function assigned_employee()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }
}
