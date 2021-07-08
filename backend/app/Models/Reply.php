<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'content',
    ];

    public function comment()
    {
        return $this->belongsTo('App\Models\Comment');
    }
}
