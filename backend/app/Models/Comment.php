<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'payment_id',
        'content'
    ];

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

    public function payment()
    {
        return $this->belongsTo('App\Models\Payment');
    }
}
