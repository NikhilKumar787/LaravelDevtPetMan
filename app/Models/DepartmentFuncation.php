<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DepartmentFuncation extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'department_funcation';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'funcation_name',
        'department_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }



}
