<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\Payment\includedPlans;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, SoftDeletes, includedPlans;

    protected $fillable = [
        'inviter_id',
        'user_id',
        'price',
        'message_status',
        'merchant_payment_id',
        'pay_jp_id',
        'payment_is_finished',
        'remarks'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function includedPlans()
    {
        return $this->belongsToMany('App\Models\Plan', 'App\Models\PlanPaymentIncluded');
    }

    public function comment()
    {
        return $this->hasOne('App\Models\Comment');
    }

    public function token()
    {
        return $this->hasOne('App\Models\PaymentToken');
    }

    public function scopeFilterByProjectId($query, $project_id)
    {
        return $query->whereIn('id', PlanPaymentIncluded::select('payment_id')->whereIn(
            'plan_id',
            Plan::select('id')->whereIn(
                'project_id',
                Project::where('id', $project_id)->pluck('id')->toArray()
            )
        ));
    }

    // FIXME ここのスコープはクエリではなくてpriceの合計値が返っている気がいたします。
    public function scopeGetTotalAmountOfSupporterWithProject($query, Project $project)
    {
        return $query->whereIn('id',
                    PlanPaymentIncluded::whereIn('plan_id',
                        $project->plans()->pluck('id')->toArray()
                    )->pluck('id')->toArray()
                )->sum('price');
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
