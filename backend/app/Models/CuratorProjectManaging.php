<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CuratorProjectManaging extends Model
{
    use HasFactory, SoftDeletes;

    public function curators()
    {
        return $this->belongsTo('App\Models\Curator');
    }

    public function projects()
    {
        return $this->belongsTo('App\Models\Project');
    }
}
