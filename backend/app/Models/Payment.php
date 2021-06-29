<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
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

    public function scopeGetTotalAmountOfSupporterWithProject($query, Project $project)
    {
        return $query->whereIn('id',
                    PlanPaymentIncluded::whereIn('plan_id',
                        $project->plans()->pluck('id')->toArray()
                    )->pluck('id')->toArray()
                )->sum('price');
    }
}
