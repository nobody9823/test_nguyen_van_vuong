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

    public function scopeMessaging($query)
    {
        return $query->whereIn('id', MessageContent::select('user_plan_billing_id'));
    }

    public function scopeNotMessaging($query)
    {
        return $query->whereNotIn('id', MessageContent::select('user_plan_billing_id'));
    }

    public function scopeSeeking($query)
    {
        return $query->whereIn('plan_id', Plan::select('id')->whereIn('project_id', Project::select('id')->seeking()));
    }

    public function scopeNotSeeking($query)
    {
        return $query->whereNotIn('plan_id', Plan::select('id')->whereIn('project_id', Project::select('id')->seeking()));
    }
}
