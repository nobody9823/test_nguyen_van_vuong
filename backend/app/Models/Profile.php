<?php

namespace App\Models;

use App\Casts\ImageCast;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Self_;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profiles';

    protected $fillable = [
        'user_id',
        'inviter_code',
        'image_url',
        'first_name_kana',
        'last_name_kana',
        'first_name',
        'last_name',
        'birth_place',
        'birthday',
        'gender',
        'introduction',
        'phone_number',
        'birthday_is_published',
        'gender_is_published',
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'image_url' => ImageCast::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function (self $profile) {
            $profile->inviter_code = \Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getBirthDay()
    {
        $date = new Carbon($this->birthday);
        return $date;
    }

    public function getYearOfBirth()
    {
        if ($this->birthday !== null) {
            return $this->getBirthDay()->year;
        }
        return null;
    }

    public function getMonthOfBirth()
    {
        if ($this->birthday !== null) {
            return $this->getBirthDay()->month;
        }
        return null;
    }

    public function getDayOfBirth()
    {
        if ($this->birthday !== null) {
            return $this->getBirthDay()->day;
        }
        return null;
    }

    public function getParsePhoneNumberAttribute()
    {
        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        $phone_number = $phoneUtil->parse($this->phone_number, "JP");
        return $phoneUtil->format($phone_number, \libphonenumber\PhoneNumberFormat::E164);
    }

    public static function initialize()
    {
        return self::make([
            'first_name' => '',
            'last_name' => '',
            'first_name_kana' => '',
            'last_name_kana' => '',
            'birth_place' => '',
            'birthday' => Carbon::minValue(),
            'gender' => 'その他',
            'introduction' => '',
            'phone_number' => '00000000000',
            'birthday_is_published' => false,
            'gender_is_published' => false,
            'image_url' => 'public/sampleImage/my-page.svg',
            'inviter_code' => '',
        ]);
    }
}
