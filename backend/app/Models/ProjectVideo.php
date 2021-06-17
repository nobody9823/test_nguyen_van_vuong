<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectVideo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'video_url'
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
}
