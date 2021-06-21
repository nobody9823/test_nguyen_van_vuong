<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProjectTagTagging extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'project_tag_tagging';

    public function projects()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function tags()
    {
        return $this->belongsTo('App\Models\Tag');
    }
}
