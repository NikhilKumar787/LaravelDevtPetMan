<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountType extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const TYPE_SELECT = [
        '1' => 'Income Account',
        '2' => 'Expenses Account',
    ];

    public const ACCOUNT_GROUP_SELECT = [
        '1' => 'Direct Income',
        '2' => 'Indirect Income',
        '3' => 'Direct Expenses',
        '4' => 'Indirect Expenses',
    ];

    public $table = 'account_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type',
        'account_group',
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function accountTypeAccountNames()
    {
        return $this->hasMany(AccountName::class, 'account_type_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
