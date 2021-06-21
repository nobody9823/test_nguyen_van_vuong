<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserPlanBilling extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_plan_billing';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }

    public function messageContents()
    {
        return $this->hasMany('App\Models\MessageContent');
    }
}
