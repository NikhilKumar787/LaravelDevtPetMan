<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class DepartmentHead extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'department_head';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'department_id',
        'company_id',
        'head_of_department_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function department_name(){
        return $this->belongsTo(Department::class ,'department_id');
    }
    public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function department_head(){
        return $this->belongsTo(User::class ,'head_of_department_id');
    }
    public function departmentTasks()
    {
        return $this->hasMany(Task::class, 'department_id', 'id');
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }



}
