<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProjectTagTagging extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'project_tag_tagging';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'tag_id',
    ];

    public function projects()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function tag()
    {
        return $this->belongsTo('App\Models\Tag');
    }
}
