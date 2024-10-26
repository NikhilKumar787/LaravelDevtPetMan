<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAlert extends Model
{
    use HasFactory;

    public $table = 'user_alerts';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'alert_text',
        'alert_link',
        'created_by_cust_id',
        'created_at',
        'updated_at',
        'model_type',
        'model_id',
        
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'model_id');
    }

    public function createdCust()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
