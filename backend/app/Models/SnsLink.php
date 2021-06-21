<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SnsLink extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'twitter_url',
        'instagram_url',
        'youtube_url',
        'tiktok_url',
        'other_url',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
