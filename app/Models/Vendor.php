<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasFactory;

    public const SECTION_SELECT = [
        '1' => 'Not Applicable',
    ];

    public const TITLE_SELECT = [
        'Mr'  => 'Mr',
        'Mrs' => 'Mrs',
    ];

    public const ENTITY_SELECT = [
        '1' => 'Resident Individual/HUF',
    ];

    public const GST_TYPE_SELECT = [
        '1' => 'GST Registered - Regular',
        '2' => 'GST Registered - Composition',
        '3' => 'GST Unregistered',
        '4' => 'Overseas',
        '5' => 'SEZ',
    ];

    public $table = 'vendors';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'company_name',
        'gst_type',
        'gstin',
        'address',
        'city_id',
        'state_id',
        'pin_code',
        'mobile',
        'email',
        'pancard',
        'other',
        'website',
        'notes',
        'payment_method',
        'term_id',
        'account_no',
        'tax_reg_no',
        'effective_date',
        'apply_tds',
        'entity',
        'section',
        'calculation_threshold',
        'is_my_customer',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id');
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
