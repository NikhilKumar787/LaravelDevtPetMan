<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomFields extends Model 
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'custom_fields';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected $fillable = [
        'custom_field_name',
        'is_required',
        'is_printable',
        'created_by_id',
        'company_id',
        'active_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function custom_field_values(){
        return $this->hasOne(CustomFieldValue::class, 'custom_field_id');
    }
    public function custom_field_map(){
        return $this->hasOne(CustomFieldMapping::class, 'custom_field_id');
    }
}
