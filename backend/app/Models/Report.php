<?php

namespace App\Models;

use App\Casts\ImageCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchFunctions;
use App\Traits\SortBySelected;
use Illuminate\Database\Eloquent\Model;
use Request;

class Report extends Model
{
    use HasFactory, SoftDeletes, SearchFunctions,SortBySelected;

    protected $fillable = [
        'project_id',
        'title',
        'content',
        'image_url',
    ];

    protected $casts = [
        'image_url' => ImageCast::class,
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function scopeNarrowDownWithProject($query)
    {
        if (Request::get('project')) {
            return $query->where('project_id', Request::get('project'));
        }
    }

    public function scopeSearch($query)
    {
        if ($this->getSearchWordInArray()) {
            foreach ($this->getSearchWordInArray() as $word) {
                $query->where(function ($query) use ($word) {
                    $query->where('title', 'like', "%$word%");
                    $query->orWhere('content', 'like', "%$word%");
                });
            }
        }
    }
}
