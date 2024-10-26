<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\MultiTenantModelTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class InvoiceCustomization extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;

    public const TYPE_OF_SELE_FROM = [
        '1' => 'Invoice',
        '2' => 'Estimate',
        '3' => 'Sales Receipt',
    ];

    public const TYPE_OF_GREETING = [
        '1' => 'Blank',
        '2' => 'To',
        '3' => 'Dear',
    ];

    public const TYPE_OF_GREETING_BY = [
        '1' => 'First Last name',
        '2' => 'Title Last name',
        '3' => 'First name',
        '4' => 'Full name',
        '5' => 'Company name',
        '6' => 'Display name',
    ];


    public $table = 'invoice_template';

    protected $appends = [
        'company_logo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
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
    
    protected $fillable = [
        'template_name',
        'template_no',
        'template_logo_alignment',
        'template_logo',
        'template_color_code',
        'template_font',
        'company_id',
        'template_properties',
        'email_content_properties',
    ];

}
