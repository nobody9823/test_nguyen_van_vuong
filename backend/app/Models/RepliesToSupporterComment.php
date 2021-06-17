<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RepliesToSupporterComment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'replies_to_supporter_comment';

    public function supporterComment()
    {
        return $this->belongsTo('App\Models\SupporterComment');
    }

    public function talent()
    {
        return $this->belongsTo('App\Models\Talent');
    }
}
