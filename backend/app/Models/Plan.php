<?php

namespace App\Models;

use App\Casts\ImageCast;
use Auth;
use App\Traits\SearchFunctions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Plan extends Model
{
    use HasFactory, SoftDeletes, SearchFunctions;

    protected $fillable = [
        'title',
        'content',
        'price',
        'address_is_required',
        'limit_of_supporters',
        'delivery_date',
        'image_url'
    ];
    protected $guarded = [
        'price',
    ];

    protected $casts = [
        'image_url' => ImageCast::class,
    ];

    public static function boot()
    {
        parent::boot();
        static::deleting(function (Plan $plan) {
            $payment_ids = $plan->includedPayments()->pluck('payments.id')->toArray();
            PlanPaymentIncluded::whereIn('payment_id', $payment_ids)->delete();
            MessageContent::whereIn('payment_id', $payment_ids)->delete();
            Payment::whereIn('id', $payment_ids)->delete();
        });
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function includedPayments()
    {
        return $this->belongsToMany('App\Models\Payment', 'App\Models\PlanPaymentIncluded');
    }

    //--------------local scope----------------//
    public function scopeWithProjectId($query, $project_id)
    {
        if ($project_id !== null) {
            $query->with('project')->where('project_id', $project_id);
        }
        return $query;
    }

    public function scopeSearch($query)
    {
        if ($this->getSearchWordInArray()) {
            foreach ($this->getSearchWordInArray() as $word) {
                $query->where(function ($query) use ($word) {
                    $query->where('title', 'like', "%$word%")->orWhere('price', 'like', "%$word");
                });
            }
        }
    }

    public function scopeSearchWithPrice($query, $min_price, $max_price)
    {
        if ($min_price !== null && $max_price !== null) {
            $query->whereBetween('price', [$min_price, $max_price])
                ->orderBy('price', 'asc');
        } elseif ($min_price !== null) {
            $query->where('price', '>=', $min_price)
                ->orderBy('price', 'asc');
        } elseif ($max_price !== null) {
            $query->where('price', '<=', $max_price)
                ->orderBy('price', 'desc');
        }
        return $query;
    }

    public function scopeSearchWithEstimatedReturnDate($query, $from_date, $to_date)
    {
        if ($from_date !== null && $to_date !== null) {
            $query->whereBetween('delivery_date', [$from_date, $to_date])
                ->orderBy('delivery_date', 'asc');
        } elseif ($from_date !== null) {
            $query->where('delivery_date', '>=', $from_date)
                ->orderBy('delivery_date', 'asc');
        } elseif ($to_date !== null) {
            $query->where('delivery_date', '<=', $to_date)
                ->orderBy('delivery_date', 'desc');
        }
        return $query;
    }
    //--------------local scope----------------//
    

    public function getSupportedUsers()
    {
        return User::whereIn('id', $this->includedPayments()->pluck('user_id'))->get();
    }

    public function deleteImage()
    {
        if (strpos($this->image_url, 'sampleImage') === false) {
            \Storage::delete($this->image_url);
        }
    }

    // NOTE:現状オプションは使用しない為、コメントアウト
    // public function saveOptions(Request $request): void
    // {
    //     if ($request->optionsToArray() !== null){
    //         $this->options()->saveMany($request->optionsToArray());
    //     }
    // }
}
