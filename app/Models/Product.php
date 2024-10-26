<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasFactory;

    public const ITEM_TYPE_RADIO = [
        'G' => 'Goods',
        'S' => 'Services',
    ];

    public const TAX_TYPE_RADIO = [
        'I' => 'Inclusive',
        'E' => 'Exclusive',
    ];

    public const PRICE_TYPE_SELECT = [
        '1' => 'With GST',
        '2' => 'Without GST',
    ];

    public const CESS_TYPE_SELECT = [
        'percent' => 'Percent wise',
        'unit'    => 'Unit wise',
    ];

    public const UNIT_SELECT = [
        'BAG' => 'BAGS',
        'BAL' => 'BALE',
        'BDL' => 'BUNDLES',
        'BKL' => 'BUCKLES',
        'BOU' => 'BILLIONS OF UNITS',
        'BOX' => 'BOX',
        'BTL' => 'BOTTLES',
        'BUN' => 'BUNCHES',
        'CAN' => 'CANS',
        'CBM' => 'CUBIC METER',
        'CCM' => 'CUBIC CENTIMETER',
        'CMS' => 'CENTIMETER',
        'CTN' => 'CARTONS',
        'DOZ' => 'DOZEN',
        'DRM' => 'DRUM',
        'GGR' => 'GREAT GROSS',
        'GMS' => 'GRAMS',
        'GRS' => 'GROSS',
        'GYD' => 'GROSS YARDS',
        'KGS' => 'KILOGRAMS',
        'KLR' => 'KILOLITER',
        'KME' => 'KILOMETRE',
        'MLT' => 'MILLILITRE',
        'MTR' => 'METERS',
        'NOS' => 'NUMBERS',
        'PAC' => 'PACKS',
        'PCS' => 'PIECES',
        'PRS' => 'PAIRS',
        'QTL' => 'QUINTAL',
        'ROL' => 'ROLLS',
        'SET' => 'SETS',
        'SQF' => 'SQUARE FEET',
        'SQM' => 'SQUARE METERS',
        'SQY' => 'SQUARE YARDS',
        'TBS' => 'TABLETS',
        'TGM' => 'TEN GROSS',
        'THD' => 'THOUSANDS',
        'TON' => 'TONNES',
        'TUB' => 'TUBES',
        'UGS' => 'US GALLONS',
        'UNT' => 'UNITS',
        'YDS' => 'YARDS',
        'OTH' => 'OTHERS',
    ];

    public const ACCOUNT_GROUP_SELECT = [
        '1' => 'Direct Income',
        '2' => 'Indirect Income',
    ];

    public const INCOME_ACCOUNT_TYPE_SELECT = [
        '1' => 'Income Account',
        '2' => 'Expense Account',
    ];

    public const GST_SELECT = [
        '0'    => 'GST @ 0%',
        '0.1'  => 'GST @ 0.1%',
        '0.25' => 'GST @ 0.25%',
        '1.5'  => 'GST @ 1.5%',
        '3'    => 'GST @ 3%',
        '5'    => 'GST @ 5%',
        '6'    => 'GST @ 6%',
        '12'   => 'GST @ 12%',
        '14'   => 'GST @ 14%',
        '18'   => 'GST @ 18%',
        '28'   => 'GST @ 28%',
    ];

    public $table = 'products';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'hsn',
        'unit',
        'sales_price',
        'tax_type',
        'gst',
        'cess',
        'cess_type',
        'purchase_price',
        'price_type',
        'item_type',
        'wholesale_price',
        'item_code',
        'income_account_type',
        'account_group',
        'account_type_id',
        'account_name_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
        'is_employee_approved',
        'company_id',
        'created_by_id',
    
    ];

    public static function boot()
    {
        parent::boot();
        // Product::observe(new \App\Observers\ProductActionObserver());
    }

    public function productInvoiceDetails()
    {
        return $this->hasMany(InvoiceDetail::class, 'product_id', 'id');
    }

    public function account_type()
    {
        return $this->belongsTo(AccountType::class, 'account_type_id');
    }

    public function account_name()
    {
        return $this->belongsTo(AccountName::class, 'account_name_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
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
