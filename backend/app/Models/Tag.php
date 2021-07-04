<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    public static function boot()
    {
        parent::boot();
        static::deleting(function(Tag $tag){
            ProjectTagTagging::where('tag_id', $tag->id)->delete();
        });
    }

    public function projects()
    {
        return $this->belongsToMany('App\Models\Project', 'App\Models\ProjectTagTagging');
    }

    public function scopePluckNameAndId($query)
    {
        return $query->pluck('name', 'id');
    }
}
