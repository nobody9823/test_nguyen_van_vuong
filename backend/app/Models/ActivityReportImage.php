<?php

namespace App\Models;

use App\Casts\ImageCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DeleteImage;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityReportImage extends Model
{
    use HasFactory, DeleteImage, SoftDeletes;

    protected $fillable = [
        'image_url'
    ];

    protected $casts = [
        'image_url' => ImageCast::class,
    ];

    public function activityReport()
    {
        return $this->belongsTo('App\Models\ActivityReport');
    }
}
