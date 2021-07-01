<?php

namespace App\Models;

use App\Casts\ImageCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchFunctions;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory, SoftDeletes, SearchFunctions;

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

    public function scopeGetReports($query)
    {
        return $query->with('project')->paginate(10);
    }

    public function scopeWithProjectId($query, $project_id)
    {
        if ($project_id !== null){
            $query->where('project_id', $project_id);
        }
        return $query;
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
