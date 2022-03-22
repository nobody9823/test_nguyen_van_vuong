<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'addresses';

    protected $fillable = [
        "postal_code",
        "prefecture",
        "city",
        "block",
        "block_number",
        "building",
        "first_name_kana",
        "last_name_kana",
        "first_name",
        "last_name",
        "phone_number",
        "is_main",
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function includedPayments()
    {
        return $this->belongsToMany('App\Models\Payment', 'App\Models\AddressPayment');
    }

    public function getPrefNameAttribute()
    {
        return config('prefecture.' . $this->prefecture_id);
    }

    public function getFormattedPostalCodeAttribute()
    {
        return substr($this->postal_code, 0, 3) . "-" . substr($this->postal_code, 3);
    }

    public function getFullAddressAttribute()
    {
        return $this->prefecture . $this->city . $this->block . $this->block_number . $this->building;
    }

    public static function initialize()
    {
        return self::make([
            'postal_code' => 0000000,
            'prefecture' => '東京都',
            'city' => '',
            'block' => '',
            'block_number' => '',
            'building' => ''
        ]);
    }
}
