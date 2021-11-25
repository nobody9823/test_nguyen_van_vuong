<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchFunctions;
use App\Traits\SortBySelected;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Request;

class Payment extends Model
{
    use HasFactory, SoftDeletes, SortBySelected, SearchFunctions;

    protected $fillable = [
        'project_id',
        'inviter_id',
        'user_id',
        'price',
        'message_status',
        'payment_way',
        'payment_is_finished',
        'is_sent',
        'remarks'
    ];

    protected $casts = [
        'is_sent' => 'boolean'
    ];

    protected static function booted()
    {
        static::addGlobalScope('payment_is_finished', function (Builder $builder) {
            $builder->where('payment_is_finished', true);
        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function includedPlans()
    {
        return $this->belongsToMany('App\Models\Plan', 'App\Models\PlanPaymentIncluded')
            ->withPivot(['quantity'])
            ->withTimestamps();
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function inviter()
    {
        return $this->belongsTo('App\Models\User', 'inviter_id');
    }

    public function comment()
    {
        return $this->hasOne('App\Models\Comment');
    }

    public function paymentToken()
    {
        return $this->hasOne('App\Models\PaymentToken');
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
            'project_id',
            Project::query()->select('id')->seeking()
        );
    }

    public function scopeNotSeeking($query)
    {
        return $query->whereNotIn(
            'project_id',
            Project::query()->select('id')->seeking()
        );
    }

    public function scopeSearch($query)
    {
        if ($this->getSearchWordInArray()) {
            foreach ($this->getSearchWordInArray() as $word) {
                $query->where(function ($query) use ($word) {
                    $query->whereIn('user_id', User::select('id')->where('name', 'like', "%$word%"))
                        ->orWhereIn('inviter_id', User::select('id')->where('name', 'like', "%$word%"))
                        ->orWhereIn('id', PaymentToken::select('payment_id')->where('order_id', 'like', "%$word%"))
                        ->orWhereIn('id', PlanPaymentIncluded::select('payment_id')->whereIn('plan_id', Plan::select('id')->whereIn('project_id', Project::select('id')->where('title', 'like', "%$word%"))))
                        ->orWhereIn('id', PlanPaymentIncluded::select('payment_id')->whereIn('plan_id', Plan::select('id')->where('title', 'like', "%$word%")));
                });
            }
        }
    }

    public function scopeNarrowDownWithProject($query)
    {
        $project_id = Request::get('project');
        if (Request::get('project')) {
            return $query->whereIn('id', PlanPaymentIncluded::select('payment_id')->whereIn('plan_id', Plan::select('id')->whereIn('project_id', Project::select('id')->where('id', $project_id))));
        }
    }
    public function scopeNarrowDownPaymentOrderId($query)
    {
        if (Request::get('order_id')) {
            $query->whereIn('id', PaymentToken::where('order_id', Request::get('order_id'))->pluck('payment_id'));
        }
        return $query;
    }
    public function scopeNarrowDownByDate($query)
    {
        if (Request::get('from_date')) {
            $from_date = new Carbon(Request::get('from_date'));
            $query->whereDate('created_at', '>=', $from_date->setTime(23, 59, 59));
        }
        if (Request::get('to_date')) {
            $to_date = new Carbon(Request::get('to_date'));
            $query->whereDate('created_at', '<=', $to_date->setTime(23, 59, 59));
        }
        return $query;
    }

    public function scopeNarrowDownByPrice($query)
    {
        if (Request::get('from_price')) {
            $query->where('price', '>=', Request::get('from_price'));
        }
        if (Request::get('to_price')) {
            $query->where('price', '<=', Request::get('to_price'));
        }
        return $query;
    }

    public function getAddedPaymentAmountAttribute()
    {
        $total_amount = 0;
        foreach ($this->includedPlans as $plan) {
            $total_amount += ($plan->price * $plan->pivot->quantity);
        }
        return $this->price - $total_amount;
    }

    public function decrementIncludedPlansQuantity()
    {
        foreach ($this->includedPlans as $includedPlan) {
            if ($includedPlan->limit_of_supporters_is_required === 1) {
                $includedPlan->limit_of_supporters -= $includedPlan->pivot->quantity;
                $includedPlan->save();
            }
        }
    }
}
