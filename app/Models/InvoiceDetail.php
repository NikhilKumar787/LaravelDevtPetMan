<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceDetail extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasFactory;

    public const TAX_SELECT = [
        '28.0% GST'    => '28.0% GST (28%)',
        '18.0% GST'    => '18.0% GST (18%)',
        '6.0% GST'     => '6.0% GST (6%)',
        '5.0% GST'     => '5.0% GST (5%)',
        '3.0% GST'     => '3.0% GST (3%)',
        '0.25% GST'    => '0.25% GST (0.25)',
        '0% GST'       => '0% GST (0%)',
        'Exempt GST'   => 'Exempt GST (0%)',
        'Out of Scope' => 'Out of Scope (0%)',
    ];

    public $table = 'invoice_details';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'invoice_id',
        'product_id',
        'qty',
        'rate',
        'amount',
        'tax',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
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
