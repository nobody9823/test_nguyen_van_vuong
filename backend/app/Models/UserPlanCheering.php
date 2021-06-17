<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;
use Illuminate\Support\Facades\Auth;

class UserPlanCheering extends Pivot
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_plan_cheering';

    protected $dates = ['deleted_at'];

    public $timestamps = true;

    public static function boot()
    {
        parent::boot();

        static::deleting(function (UserPlanCheering $user_plan_cheerting) {
            MessageContent::where('user_plan_cheerting_id', $user_plan_cheerting->id)->update(['deleted_at' => Carbon::now()]);
        });
    }

    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function messageContents()
    {
        return $this->hasMany(MessageContent::class, 'user_plan_cheering_id');
    }

    public function scopeSearchWords($query, $words)
    {
        if ($words[0] !== "") {
            foreach ($words as $word) {
                $query->where(function ($query) use ($word) {
                    $query->whereIn(
                        'plan_id',
                        Plan::searchWord($word)
                                                ->searchWordWithProjectId(
                                                    Project::searchWord($word)
                                                    ->searchWordWithTalentId(
                                                        Talent::searchWord($word)
                                                            ->searchByWordWithCompanyId(
                                                                Company::searchCompaniesToArray($word)
                                                            )
                                                            ->pluck('id')
                                                            ->toArray()
                                                    )
                                                    ->pluck('id')
                                                    ->toArray()
                                                )
                                                ->pluck('id')
                                                ->toArray()
                    );
                    $query->orWhereIn('user_id', User::searchUsersToArray($word));
                });
            }
        }
    }

    public function scopeSearchPurchaseDate($query, $from_date, $to_date)
    {
        if (isset($from_date) && !isset($to_date)) {
            $from_date = new Carbon($from_date);
            $query->whereDate('created_at', '>=', $from_date->setTime(23, 59, 59));
        } elseif (!isset($from_date) && isset($to_date)) {
            $to_date = new Carbon($to_date);
            $query->whereDate('created_at', '<=', $to_date->setTime(23, 59, 59));
        } elseif (isset($from_date) && isset($to_date)) {
            $from_date = new Carbon($from_date);
            $to_date = new Carbon($to_date);
            $query->whereBetween('created_at', [$from_date->setTime(23, 59, 59), $to_date->setTime(23, 59, 59)]);
        }
        return $query;
    }

    public function scopeSearchPurchasePrice($query, $price)
    {
        if (isset($price)) {
            $query->whereIn('plan_id', Plan::query()->select('id')->where('price', '=', "$price"));
        }
        return $query;
    }

    public function scopeGetMessageByCompany($query)
    {
        return $query->whereIn('plan_id', Plan::select('id')->whereIn('project_id', Project::select('id')->whereIn('talent_id', Talent::select('id')->where('company_id', Auth::guard('company')->id()))));
    }

    public function scopeGetMessageByTalent($query)
    {
        return $query->whereIn('plan_id', Plan::select('id')->whereIn('project_id', Project::select('id')->where('talent_id', Auth::guard('talent')->id())));
    }

    public function scopeWordSearch($query)
    {
        $request = Request::query('message_word');
        if ($request) {
            return $query->where(function ($query) use ($request) {
                $query->whereIn('plan_id', Plan::select('id')->where('title', 'like', "%$request%"))->orWhereIn('user_id', User::select('id')->where('name', 'like', "%$request%"));
            });
        } else {
            return $query;
        }
    }

    public function scopeMessaging($query)
    {
        return $query->whereIn('id', MessageContent::select('user_plan_cheering_id'));
    }

    public function scopeNotMessaging($query)
    {
        return $query->whereNotIn('id', MessageContent::select('user_plan_cheering_id'));
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
