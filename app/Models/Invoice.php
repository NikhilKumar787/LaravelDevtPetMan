<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasFactory;

    public const TYPE_RADIO = [
        '1' => 'Tax Invoice',
        '2' => 'Bill of Supply',
    ];

    public const DISCOUNT_TYPE_SELECT = [
        'Discount Percent' => 'Discount Percent',
        'Discount Value'   => 'Discount Value',
    ];

    public const TYPE_OF_SUPPLY_SELECT = [
        '1' => 'Business 2 Business',
        '2' => 'Business 2 Customer (Small)',
        '3' => 'Business 2 Customer (Large)',
        '4' => 'Special Economic Zone (Without Payment)',
        '5' => 'Special Economic Zone (With Payment)',
        '6' => 'Deemed Export',
        '7' => 'Export with Payment (EXPWP)',
        '8' => 'Export without Payment (EXPWOP)',
    ];

    public $table = 'invoices';

    protected $dates = [
        'invoice_date',
        'due_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type',
        'invoice_request',
        'invoice_status',
        'company_id',
        'invoice_date',
        'invoice_prefix',
        'invoice_no',
        'customer_id',
        'customer_email',
        'send_later',
        'due_date',
        'place_of_supply_id',
        'type_of_supply',
        'message_on_invoice',
        'message_on_statement',
        'discount_type',
        'discount_amount',
        'total_amount',
        'total_tax_amount',
        'remaining_payable_amount',
        'total_payable_amount',
        'created_at',
        'company_id',
        'selected_bank',
        'template_id',
        'terms_and_condition_id',
        'updated_at',
        'deleted_at',
        'team_id',
        'billing_address',
        'shipping_address',
        'is_employee_approved',
        'po_no',
        'created_by_id',
        'posted',
        'task_due_date',
    ];

    const INVOICE_COPY = [
        '0' => 'Physical',
        '1' => 'Soft',
        '2' => 'Both'
    ];

    public static function boot()
    {
        parent::boot();
        // Invoice::observe(new \App\Observers\InvoiceActionObserver());
    }

    public function invoiceInvoiceDetails()
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id', 'id');
    }

    public function getInvoiceDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setInvoiceDateAttribute($value)
    {
        $this->attributes['invoice_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function template()
    {
        return $this->belongsTo(InvoiceCustomization::class, 'template_id');
    }


    public function bank_details()
    {
        return $this->belongsTo(BankDetail::class, 'selected_bank');
    }

    public function getDueDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function place_of_supply()
    {
        return $this->belongsTo(State::class, 'place_of_supply_id');
    }

    public function terms_and_condition()
    {
        return $this->belongsTo(TermsAndcondition::class, 'terms_and_condition_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
