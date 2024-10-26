<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoicePayment extends Model
{ 
    use HasFactory;
    use SoftDeletes;


    public $table = 'invoice_payments';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected $fillable = [
        'invoice_id',
        'received_amount',
        'customer_id',
        'payment_method',
        'reference_no',
        'deposit_to',
        'description',
        'company_id',
        'deposited_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


}
