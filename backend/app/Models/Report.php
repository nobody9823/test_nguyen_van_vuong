<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function scopeGetReports($query)
    {
        return $query->with('project')->paginate(10);
    }
}
