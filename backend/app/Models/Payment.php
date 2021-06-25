<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function includedPlans()
    {
        return $this->belongsToMany('App\Models\Plan', 'App\Models\PlanPaymentIncluded');
    }

    public function messageContents()
    {
        return $this->hasMany('App\Models\MessageContent');
    }

    public function scopeMessaging($query)
    {
        return $query->whereIn('id', MessageContent::select('payment_id'));
    }

    public function scopeNotMessaging($query)
    {
        return $query->whereNotIn('id', MessageContent::select('payment_id'));
    }

    public function scopeSeeking($query)
    {
        return $query->whereIn(
            'id', PlanPaymentIncluded::query()->select('payment_id')->whereIn(
                'plan_id', Plan::query()->select('id')->whereIn(
                    'project_id', Project::query()->select('id')
                        ->seeking()
                )
            )
        );
    }

    public function scopeNotSeeking($query)
    {
        return $query->whereNotIn(
            'id', PlanPaymentIncluded::query()->select('payment_id')->whereIn(
                'plan_id', Plan::query()->select('id')->whereIn(
                    'project_id', Project::query()->select('id')
                        ->seeking()
                )
            )
        );
    }
}
