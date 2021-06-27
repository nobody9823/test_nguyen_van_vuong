<?php

namespace App\Models;

use App\Casts\ImageCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory, SoftDeletes;

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

    public function scopeSearchByArrayWords($query, $words)
    {
        if($words[0] !== ""){
            $query->where( function($query) use ($words){
                foreach($words as $word){
                    $query->where('title', 'like', "%$word%");
                    $query->orWhere('content', 'like', "%$word%");
                }
            });
        }

        return $query;
    }

    public function scopeWithProjectId($query, $project_id)
    {
        if ($project_id !== null){
            $query->where('project_id', $project_id);
        }
        return $query;
    }
}
