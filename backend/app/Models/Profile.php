<?php

namespace App\Models;

use App\Casts\ImageCast;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        if ($this->birthday !== null)
        {
            return $this->getBirthDay()->year;
        }
        return null;
    }

    public function getMonthOfBirth()
    {
        if ($this->birthday !== null)
        {
            return $this->getBirthDay()->month;
        }
        return null;
    }

    public function getDayOfBirth()
    {
        if ($this->birthday !== null)
        {
            return $this->getBirthDay()->day;
        }
        return null;
    }
}
