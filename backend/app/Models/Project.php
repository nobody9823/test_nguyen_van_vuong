<?php

namespace App\Models;

use App\Casts\PurifierCast;
use Auth;
use App\Models\UserProjectLiked;
use App\Traits\SearchFunctions;
use App\Traits\SortBySelected;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Storage;

use function PHPUnit\Framework\isEmpty;

class Project extends Model
{
    use HasFactory, SoftDeletes, SearchFunctions, SortBySelected;

    protected $fillable = [
        'user_id',
        'curator_id',
        'title',
        'content',
        'reward_by_total_amount',
        'reward_by_total_quantity',
        'target_number',
        'start_date',
        'end_date',
    ];

    protected $dates = ['start_date', 'end_date'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'content' => PurifierCast::class,
        'reward_by_total_amount' => PurifierCast::class,
        'reward_by_total_quantity' => PurifierCast::class,
    ];

    public static function boot()
    {
        parent::boot();
        static::deleting(function (Project $project) {
            // プロジェクト画像と動画の論理削除
            $project->projectFiles()->delete();
            $project->projectTagTagging()->delete();
            $project->reports()->delete();

            // リターンのリレーション先も論理削除
            $plan_ids = $project->plans()->pluck('id')->toArray();
            $plan_payment_included_payment_ids = PlanPaymentIncluded::whereIn('plan_id', $plan_ids)->pluck('payment_id')->toArray();
            $payment_ids = Payment::whereIn('id', $plan_payment_included_payment_ids)->pluck('id')->toArray();
            $message_ids = MessageContent::whereIn('payment_id', $payment_ids)->pluck('id')->toArray();
            PlanPaymentIncluded::whereIn('payment_id', $payment_ids)->delete();
            MessageContent::destroy($message_ids);
            Payment::destroy($payment_ids);
            Plan::destroy($plan_ids);
            // コメントのリレーション先も論理削除
            $comment_ids = $project->comments()->pluck('id')->toArray();
            Reply::whereIn('comment_id', $comment_ids)->delete();
            Comment::destroy($comment_ids);
            // user project liked の論理削除
            UserProjectLiked::where('project_id', $project->id)
                ->update(array('deleted_at' => Carbon::now()));
        });
    }

    public function projectFiles()
    {
        return $this->hasMany('App\Models\ProjectFile');
    }

    public function plans()
    {
        return $this->hasMany('App\Models\Plan');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function likedUsers()
    {
        return $this->belongsToMany('App\Models\User', 'user_project_liked')
            ->using('App\Models\UserProjectLiked')
            ->withTimestamps();
    }

    public function supportedUsers()
    {
        return $this->belongsToMany('App\Models\User', 'user_project_supported')
            ->using('App\Models\UserProjectSupported')
            ->withTimestamps();
    }

    public function reports()
    {
        return $this->hasMany('App\Models\Report');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'App\Models\ProjectTagTagging');
    }

    public function projectTagTagging()
    {
        return $this->hasMany('App\Models\ProjectTagTagging');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function curator()
    {
        return $this->belongsTo('App\Models\Curator', 'curator_id');
    }

    //--------------local scope----------------//

    public function scopeGetReleasedProject($query)
    {
        return $query->where('release_status', '掲載中');
    }

    // 'Payments'テーブルのユーザーカウント数と'price'の合計をカラムに持たせた'payments'をリレーションとして取得しています。
    public function scopeGetWithPaymentsCountAndSumPrice($query)
    {
        // 重複するuser_idを削除して、支援者数を算出する。
        $sub_query = Payment::selectRaw('count(distinct(`user_id`))')
                    ->from('payments')
                    ->whereColumn('projects.id','payments.project_id')
                    ->toSql();

        return $query->selectRaw("`projects`.*,($sub_query) as `payments_count`")->withSum('payments', 'price');
    }

    public function getLoadIncludedPaymentsCountAndSumPrice()
    {
        $this->plans->loadCount('includedPayments');
        $this->loadSum('payments', 'price');
        return $this;
    }

    public function scopeMainProjects($query)
    {
        return $query->getReleasedProject()->seeking()->getWithPaymentsCountAndSumPrice();
    }

    public function scopeCompletedProjects($query)
    {
        return $query->getReleasedProject()->AfterSeeking()->getWithPaymentsCountAndSumPrice();
    }

    public function scopeOrdeyByLikedUsers($query)
    {
        // return $query->withCount('users')->orderByRaw('users_count + added_like DESC');
        return $query->withCount('likedUsers')->orderBy('liked_users_count', 'DESC');
    }

    public function scopeOrderByNearlyDeadline($query)
    {
        return $query->orderBy(\DB::raw('abs(datediff(CURDATE(), end_date))'), "ASC");
    }

    // NOTE:現状「もうすぐ公開のプロジェクト」は無い為、コメントアウト
    // public function scopeOrderByNearlyOpen($query)
    // {
    //     return $query->where('start_date', '>', Carbon::now())->orderBy(\DB::raw('abs(datediff(CURDATE(), start_date))'), "ASC");
    // }

    public function scopeBeforeSeeking($query)
    {
        return $query->where('start_date', '>', Carbon::now());
    }

    public function scopeSeeking($query)
    {
        return $query->where('start_date', '<', Carbon::now())->where('end_date', '>', Carbon::now());
    }

    public function scopeAfterSeeking($query)
    {
        return $query->where('end_date', '<', Carbon::now());
    }

    public function scopeSeekingWithAfterSeeking($query)
    {
        return $query->where('start_date', '<', Carbon::now());
    }

    public function scopeDaysLeftSeeking($query, $start_or_end_date)
    {
        return $query->whereBetween($start_or_end_date, [Carbon::now(), Carbon::now()->addWeek(1)]);
    }

    public function scopeSearchWithReleaseStatus($query, $release_statuses)
    {
        if (is_array($release_statuses) && optional($release_statuses)[0] !== null) {
            $query->where(function ($query) use ($release_statuses) {
                foreach ($release_statuses as $release_status) {
                    $query->orWhere('release_status', $release_status);
                }
            });
        }
        return $query;
    }

    public function scopeSearch($query, $role)
    {
        if ($this->getSearchWordInArray()) {
            foreach ($this->getSearchWordInArray() as $word) {
                $query->where(function ($query) use ($word, $role) {
                    $query->SearchWords($word, $role);
                });
            }
        }
    }

    public function scopeSearchWords($query, $word, $role)
    {
        if ($role === 'user') {
            return $query->where('title', 'like', "%$word%")
                ->orWhereIn('user_id', User::select('id')->where('name', 'like', "%$word%"));
        } elseif ($role === 'admin') {
            return $query->where('title', 'like', "%$word%")
                ->orWhereIn('curator_id', Curator::select('id')->where('name', 'like', "%$word%"))
                ->orWhere('id', 'like', "%$word%")
                ->orWhereIn('user_id', User::select('id')->where('name', 'like', "%$word%"));
        }
    }

    //--------------local scope----------------//


    public function getTotalLikesAttribute()
    {
        return $this->likedUsers()->count() + $this->added_like;
    }

    public function getDisplayIdAttribute()
    {
        return 'PR' . sprintf('%05d', $this->id);
    }

    public function getNumberOfDaysLeftAttribute()
    {
        $end_date = new Carbon($this->end_date);
        $today = Carbon::now();
        return $end_date->diffInDays($today);
    }

    public function getPaymentsCountAttribute()
    {
        return $this->payments->groupBy('user_id')->count();
    }
    
    public function getPaymentsCountWithinADayAttribute()
    {
        return $this->payments->where('created_at', '>=', Carbon::now()->subHours(24))->groupBy('user_id')->count();
    }

    // 目標金額に対する支援総額の割合
    // scopeGetWithPlansWithInPaymentsCountAndSumPriceを呼んでいないと使えないです。
    public function getAchievementRateAttribute()
    {
        // 金額の達成率の算出
        if ($this->target_number > 0) {
            return round($this->payments_count * 100 / $this->target_number);
        } else { // ゼロ除算対策
            return 100;
        }
    }

    public function loadOtherRelations()
    {
        $relationTables = ['comments','reports','payments'];
        foreach($relationTables as $relationTable){
            $this->load([$relationTable => function ($query) {
                $query->orderBy('created_at', 'desc');
            }]);
        }
        
        return $this;
    }

    /**
     * Get Japanese formatted start time of project with day of the week
     *
     * @return string
     */
    public function getStartDate()
    {
        return $this->start_date->isoFormat('YYYY年MM月DD日(ddd)');
    }

    /**
     * Get Japanese formatted end time of project with day of the week
     *
     * @return string
     */
    public function getEndDate()
    {
        return $this->end_date->isoFormat('YYYY年MM月DD日(ddd)');
    }

    //-----------------掲載状態変更functions------------------------
    public function changeStatusToRelease()
    {
        DB::transaction(function () {
            $this->release_status = '掲載中';
            $this->save();
        });
        \Session::flash('flash_message', '掲載状態の変更が完了しました。');
    }

    public function changeStatusToPending()
    {
        DB::transaction(function () {
            $this->release_status = '承認待ち';
            $this->save();
        });
        \Session::flash('flash_message', '掲載状態の変更が完了しました。');
    }

    public function changeStatusToSendBack()
    {
        DB::transaction(function () {
            $this->release_status = '差し戻し';
            $this->save();
        });
        \Session::flash('flash_message', '掲載状態の変更が完了しました。');
    }

    public function changeStatusToDefault()
    {
        DB::transaction(function () {
            $this->release_status = '---';
            $this->save();
        });
        \Session::flash('flash_message', '掲載状態の変更が完了しました。');
    }

    public function changeStatusToUnderSuspension()
    {
        DB::transaction(function () {
            $this->release_status = '掲載停止中';
            $this->save();
        });
        \Session::flash('flash_message', '掲載状態の変更が完了しました。');
    }
    //-----------------掲載状態変更functions------------------------

    // プロジェクトの持つリターンをログインしているユーザーが支援しているかを確認
    public function isIncluded()
    {
        $plans = $this->plans()->whereIn(
            'id',
            PlanPaymentIncluded::query()->select('plan_id')->whereIn(
                'payment_id',
                Payment::query()->select('id')->where(
                    'user_id',
                    Auth::id()
                )
            )
        )->get();
        $is_included = false;
        if (!$plans->isEmpty()) {
            $is_included = true;
        }
        return $is_included;
    }

    public function saveProjectImages(array $images): void
    {
        if (!empty($images) && $images[0] !== null) {
            $this->projectFiles()->saveMany($images);
        }
    }

    public function saveProjectVideo($projectVideo)
    {
        // ユーザーがURLを入力していないor更新する際にURLが変更されていない場合
        if (optional($projectVideo)->file_url === null || optional($this->projectFiles()->where('file_content_type', 'video_url')->first())->file_url === optional($projectVideo)->file_url) {
            return false;
        // 新規作成の時or更新する際に動画のURLが存在しない場合
        } elseif (optional($this->projectFiles()->where('file_content_type', 'video_url')->first())->file_url === null && optional($projectVideo)->file_url !== null) {
            $this->projectFiles()->save($projectVideo);
        // プロジェクト更新時に既に埋め込んでいるURLから別のURLに変更した場合
        } elseif (optional($this->projectFiles()->where('file_content_type', 'video_url')->first())->file_url !== optional($projectVideo)->file_url) {
            $this->projectFiles()->where('file_content_type', 'video_url')->first()->delete();
            $this->projectFiles()->save($projectVideo);
        };
    }

    public function deleteProjectFiles(): void
    {
        foreach ($this->projectFiles as $file) {
            if (strpos($file->file_url, 'sampleImage') === false && $file->file_content_type === 'image_url') {
                Storage::delete($file->file_url);
            };
            $file->delete();
        }
    }

    public static function initialize()
    {
        $date = new Carbon();

        return self::make([
            'title' => '',
            'content' => '',
            'reward_by_total_amount' => '',
            'reward_by_total_quantity' => '',
            'target_number' => 0,
            'curator' => '',
            'start_date' => Carbon::now(),
            'end_date' => $date->addYear(2),
            'release_status' => '---',
        ]);
    }
}
