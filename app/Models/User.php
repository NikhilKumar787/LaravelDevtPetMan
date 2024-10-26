<?php

namespace App\Models;

use \DateTimeInterface;
use App\Notifications\VerifyUserNotification;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use SoftDeletes;
    use Notifiable;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'users';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $appends = [
        'identity_proof',
        'address_proof',
        'passport_size_photo',
    ];

    protected $dates = [
        'email_verified_at',
        'verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'email_verified_at',
        'password',
        'approved',
        'verified',
        'verified_at',
        'verification_token',
        'remember_token',
        'profile',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (User $user) {
            if (auth()->check()) {
                $user->verified = 1;
                $user->verified_at = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
                $user->save();
            } elseif (!$user->verification_token) {
                $token = Str::random(64);
                $usedToken = User::where('verification_token', $token)->first();

                while ($usedToken) {
                    $token = Str::random(64);
                    $usedToken = User::where('verification_token', $token)->first();
                }

                $user->verification_token = $token;
                $user->save();

                $registrationRole = config('panel.registration_default_role');
                if (!$user->roles()->get()->contains($registrationRole)) {
                    $user->roles()->attach($registrationRole);
                }

                // $user->notify(new VerifyUserNotification($user));
            }
        });
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id','!=', 2)->exists();
    }

    public function getIsUserAttribute()
    {
        return $this->roles()->where('id', 2)->exists();
    }
    
    public function getIsCustomerAttribute()
    {
        return $this->roles()->whereIn('id', [4,7])->exists();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function assignedToAssignedTasks()
    {
        return $this->hasMany(AssignedTask::class, 'assigned_to_id', 'id');
    }

    public function userAssignedTasks()
    {
        return $this->hasMany(AssignedTask::class, 'user_id', 'id');
    }

    public function userAssignedTaskDetails()
    {
        return $this->hasMany(AssignedTaskDetail::class, 'user_id', 'id');
    }

    public function userUserAddresses()
    {
        return $this->hasMany(UserAddress::class, 'user_id', 'id');
    }

    public function userUserAlerts()
    {
        return $this->belongsToMany(UserAlert::class);
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function getVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setVerifiedAtAttribute($value)
    {
        $this->attributes['verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getIdentityProofAttribute()
    {
        $files = $this->getMedia('identity_proof');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function getAddressProofAttribute()
    {
        $files = $this->getMedia('address_proof');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function getPassportSizePhotoAttribute()
    {
        $file = $this->getMedia('passport_size_photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
    public function company(){
        return $this->belongsTo(Company::class,'taxtube_teams');
    }

    public function attendance(){
        // return $this->belongsToMany(Attendance::class);
        return $this->hasMany(Attendance::class, 'emp_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
