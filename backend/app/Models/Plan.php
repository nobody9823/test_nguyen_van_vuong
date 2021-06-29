<?php

namespace App\Models;

use App\Casts\ImageCast;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Plan extends Model
{
    use HasFactory, SoftDeletes;

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
        static::deleting(function(Plan $plan){
            $payment_ids = $plan->includedPayments()->pluck('payments.id')->toArray();
            PlanPaymentIncluded::whereIn('payment_id', $payment_ids)->delete();
            MessageContent::whereIn('payment_id', $payment_ids)->delete();
            Payment::whereIn('id', $payment_ids)->delete();
        });
    }

    // NOTE:scopeGetPlansByCompanyとscopeGetPlansByTalentの処理で、ログインユーザーと同じカンパニー・タレントidのプランを取得する処理を記載しているが、この処理は現状必要ない(もし、無くても正常に動作する)
    // ※return $query->where('project_id', $project_id);   ・・・ 本来はこれだけでも問題ない。
    // しかし、今後の仕様変更によりプロジェクト管理画面を経由せず、個別でプラン管理画面に画面遷移する事になった場合を見据え、そのまま記載している。
    public function scopeGetPlansByCompany($query)
    {
        return $query->whereIn('project_id', Project::select('id')
                        ->whereIn('talent_id', Talent::select('id')
                            ->where('company_id', Auth::id())->get()
                    )->get()
                );
    }

    public function scopeGetPlansByTalent($query)
    {
        return $query->whereIn('project_id', Project::select('id')
                    ->where('talent_id', Auth::id())->get());
    }

    public function scopeSearchWord($query, $word)
    {
        return $query->where('title', 'like', "%$word%")
                    ->orWhere('price', 'like', "%$word");
    }

    public function scopeSearchByWords($query, $words)
    {
        if ($words[0] !== ""){
            foreach($words as $word){
                $query->where(function ($query) use ($word){
                    $query->searchWord($word);
                });
            }
        }
        return $query;
    }

    public function scopeWithProjectId($query, $project_id){
        if ($project_id !== null){
            $query->with('project')->where('project_id', $project_id);
        }
        return $query;
    }

    public function scopeSearchWordWithProjectId($query, $projects)
    {
        return $query->orWhereIn('project_id', $projects);
    }

    public function scopeSearchWithPrice($query, $min_price, $max_price)
    {
        if ($min_price !== null && $max_price !== null){
            $query->whereBetween('price', [$min_price, $max_price])
                ->orderBy('price', 'asc');
        } elseif ($min_price !== null){
            $query->where('price', '>=', $min_price)
                ->orderBy('price', 'asc');
        } elseif ($max_price !== null){
            $query->where('price', '<=', $max_price)
                ->orderBy('price', 'desc');
        }
        return $query;
    }

    public function scopeSearchWithEstimatedReturnDate($query, $from_date, $to_date)
    {
        if ($from_date !== null && $to_date !== null){
            $query->whereBetween('delivery_date', [$from_date, $to_date])
                ->orderBy('delivery_date', 'asc');
        } elseif ($from_date !== null){
            $query->where('delivery_date', '>=', $from_date)
                ->orderBy('delivery_date', 'asc');
        } elseif ($to_date !== null){
            $query->where('delivery_date', '<=', $to_date)
                ->orderBy('delivery_date', 'desc');
        }
        return $query;
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function includedPayments()
    {
        return $this->belongsToMany('App\Models\Payment', 'App\Models\PlanPaymentIncluded');
    }

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
