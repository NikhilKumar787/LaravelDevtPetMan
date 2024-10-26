<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'company_bank_details';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bank_name',
        'account_holder_name',
        'account_no',
        'ifsc_code',
        'branch_name',
        'company_id',
        'set_as_default',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
