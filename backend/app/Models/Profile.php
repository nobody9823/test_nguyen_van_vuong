<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profiles';

    protected $fillable = [
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

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
