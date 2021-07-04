<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserPlanBilling extends Pivot
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

    public function inviter()
    {
        return $this->belongsTo('App\Models\User', 'inviter_id');
        // 招待者コードから検索する場合
        // return $this->belongsTo('App\Models\User', 'inviter_code', 'inviter_code');
    }
}
