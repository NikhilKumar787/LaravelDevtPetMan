<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const TYPE_SELECT = [
        'Shipping' => 'Shipping Address',
        'Billing'  => 'Billing Address',
    ];

    public $table = 'user_addresses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'phone_no',
        'addressline_1',
        'addressline_2',
        'city',
        'zip_code',
        'state',
        'customer_id',
        'user_id',
        'uuid',
        'type',
        'same_as',
        'default_address',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
