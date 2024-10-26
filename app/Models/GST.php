<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GST extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'gst';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'gst',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
