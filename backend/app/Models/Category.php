<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function project(){
        return $this->belongsTo('App\Models\Project');
    }

    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }

    // FIXME 命名が抽象的すぎるので直したい
    public function scopeGetCategories()
    {
        return $this->paginate(10);
    }

    public function scopePluckNameAndId()
    {
        return $this->pluck('name', 'id');
    }
}
