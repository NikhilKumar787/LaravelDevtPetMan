<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Company extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'companies';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'company_logo',
        'copy_of_pan_tan',
        'gst_certificate',
        'vat_certficate',
        'msme_registration_certificate',
        'shop_establishment_certificate',
        'address_proof',
        'stamp_and_sign',
    ];

    protected $fillable = [
        'username_for_pan_tan',
        'password_for_pan_tan',
        'username_for_gst_vat_icegate_dgft',
        'password_for_gst_vat_icegate_dgft',
        'username_for_e_way_e_invoicing',
        'password_for_e_way_e_invoicing',
        'username_for_traces',
        'password_for_traces',
        'username_for_pf_esi_and_other_labour_law',
        'password_for_pf_esi_and_other_labour_law',
        'username_for_reporting_portal',
        'password_for_reporting_portal',
        'company_name',
        'gstin',
        'cin',
        'address_line_1',
        'address_line_2',
        'pin_code',
        'city_id',
        'state_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
        'company_type_id',
        'taxtube_teams',
        'team_limit',
        'selected_bank',
        'owner_limit',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function companyAssignedTasks()
    {
        return $this->hasMany(AssignedTask::class, 'company_id', 'id');
    }

    public function getCompanyLogoAttribute()
    {
        $file = $this->getMedia('company_logo')->last();
        if($file){
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }
        
        return $file;
    }
    public function getCopyOfPanTanAttribute()
    {
        $file = $this->getMedia('copy_of_pan_tan')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getGstCertificateAttribute()
    {
        $file = $this->getMedia('gst_certificate')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getVatCertficateAttribute()
    {
        $file = $this->getMedia('vat_certficate')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getMsmeRegistrationCertificateAttribute()
    {
        $file = $this->getMedia('msme_registration_certificate')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getShopEstablishmentCertificateAttribute()
    {
        $file = $this->getMedia('shop_establishment_certificate')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getAddressProofAttribute()
    {
        $file = $this->getMedia('address_proof')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function getStampAndSignAttribute()
    {
        $file = $this->getMedia('stamp_and_sign')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
 
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function department()
    {
        return $this->belongsTo(DepartmentHead::class, 'id');
    }

    public function bank(){

        return $this->belongsTo(BankDetail::class, 'selected_bank');
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
