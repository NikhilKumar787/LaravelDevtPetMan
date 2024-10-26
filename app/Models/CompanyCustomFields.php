<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyCustomFields extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'company_custom_fields';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected $fillable = [
        'custom_field_label',
        'custom_field_value',
        'company_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
