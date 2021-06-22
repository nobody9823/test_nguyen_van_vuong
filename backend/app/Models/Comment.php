<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    public static function boot()
    {
        parent::boot();
        static::deleting(function(Comment $comment){
            $comment->replies()->delete();
        });
    }

    public function reply()
    {
        return $this->hasOne('App\Models\Reply');
    }
}
