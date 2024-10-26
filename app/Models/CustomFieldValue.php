<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomFieldValue extends Model
{
    protected $table = "custom_field_values";

    protected $date = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'custom_field_id',
        'custom_field_request_id',
        'custom_field_map_id',
        'custom_field_value',
    ];
    public function custom_field_map(){
        return $this->belongsTo(CustomFieldMapping::class, 'custom_field_map_id');
    }
    public function custom_fields(){
        return $this->belongsTo(CustomFields::class, 'custom_field_id');
    }
}
