<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Customer extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use HasFactory;

    public const TITLE_SELECT = [
        'Mr'  => 'Mr',
        'Mrs' => 'Mrs',
    ];

    public const PAYMENT_METHOD_SELECT = [
        'cash'   => 'Cash',
        'online' => 'Online',
    ];

    public const DELIVERY_METHOD_SELECT = [
        '0' => 'Vendor',
        '1' => 'Delivery Partner',
    ];

    public const GST_TYPE_SELECT = [
        '1' => 'Consumer',
        '2' => 'Registered Business',
        '3' => 'Un Registered Business',
        '4' => 'Overseas / Export',
        '5' => 'Sez',
    ];

    public $table = 'customers';

    protected $appends = [
        'attachment',
    ];

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
        'gstin',
        'gst_type',
        'gst_customer_name',
        'mobile',
        'address',
        'city_id',
        'state_id',
        'country_id',
        'pin_code',
        'company',
        'other',
        'website',
        'phone',
        'term_id',
        'notes',
        'pan_no',
        'tan',
        'payment_method',
        'delivery_method',
        'optional_data_1',
        'optional_data_2',
        'email',
        'created_at',
        'is_my_vendor',
        'updated_at',
        'deleted_at',
        'team_id',
        'company_id',
        'is_employee_approved',
        'created_by_id',
    ];

    public static function boot()
    {
        parent::boot();
        // Customer::observe(new \App\Observers\CustomerActionObserver());
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function customerUserAddresses()
    {
        return $this->hasMany(UserAddress::class, 'customer_id', 'id');
    }

    public function customersGroups()
    {
        return $this->belongsToMany(Group::class);
    }
    
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id');
    }
    public function company(){
        
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getAttachmentAttribute()
    {
        return $this->getMedia('attachment')->last();
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
