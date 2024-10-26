<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomFieldMapping extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    protected $table = "custom_field_mapping";

    protected $date = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'custom_field_id',
        'custom_field_request_type',
    ];

    public function custom_fields(){
        return $this->belongsTo(CustomFields::class, 'custom_field_id');
    }
    
}
