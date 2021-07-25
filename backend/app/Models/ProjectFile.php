<?php

namespace App\Models;

use App\Casts\ImageCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

class ProjectFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'file_url',
        'file_content_type'
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'file_url' => ImageCast::class,
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function deleteFile(): void
    {
        if (strpos($this->file_url, 'sampleImage') === false && $this->file_content_type === 'image_url') {
            Storage::delete($this->file_url);
        };
        $this->delete();
    }

    public static function initialize()
    {
        return self::make([
            'file_url' => 'public/sampleImage/now_printing.png',
            'file_content_type' => 'image_url',
        ]);
    }
}
