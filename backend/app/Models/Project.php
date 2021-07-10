<?php

namespace App\Models;

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
    use HasFactory, SoftDeletes,SearchFunctions,SortBySelected;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'target_amount',
        'curator',
        'start_date',
        'end_date',
    ];

    protected $dates = ['start_date', 'end_date'];

    public static function boot()
    {
        parent::boot();
        static::deleting(function(Project $project){
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



    //--------------local scope----------------//
    public function scopeGetProjectsWithPaginate($query)
    {
        return $query->with('user')->orderBy('created_at', 'desc')->paginate(10);
    }

    public function scopeGetReleasedProject($query)
    {
        return $query->where('release_status', '掲載中');
    }

    //company_id = Auth::id()のtalentを持つprojectを持ってくる
    public function scopeGetProjectsByCompany($query)
    {
        return $query
        ->whereIn('talent_id', Talent::select('id')
        ->where('company_id', Auth::id()))->getProjects();
    }

    //talent_id = Auth::id()のprojectを持ってくる
    public function scopeGetProjectsByTalent($query)
    {
        return $query->where('talent_id', Auth::id())->getProjects();
    }

    // includedPaymentsのカウント数と'price'の合計をカラムに持たせた'plans'をリレーションとして取得しています。
    public function scopeGetWithPaymentsCountAndSumPrice($query)
    {
        return $query->with(['plans' => function ($query) {
            $query
                ->withCount('includedPayments')
                ->withSum('includedPayments', 'price');
        }]);
    }

    public function getLoadPaymentsCountAndSumPrice()
    { 
        return $this->load(['plans' => function($query){
            $query->withCount('includedPayments')
                  ->withSum('includedPayments', 'price');
        }]);
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

    public function scopeOrderByNearlyOpen($query)
    {
        return $query->where('start_date', '>', Carbon::now())->orderBy(\DB::raw('abs(datediff(CURDATE(), start_date))'), "ASC");
    }

    public function scopeOnlyBillingDisplay($query)
    {
        return $query
        ->whereIn('projects.id',Plan::select('project_id')
        ->whereIn('id',UserPlanBilling::select('plan_id')
        ->whereIn('user_id',User::select('id')->where('id', Auth::id())
        )));
    }

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

    public function scopeDaysLeftSeeking($query,$start_or_end_date)
    {
        return $query->whereBetween($start_or_end_date, [Carbon::now(), Carbon::now()->addWeek(1)]);
    }

    public function scopeSearchByArrayWords($query, $words)
    {
        if($words[0] !== ""){
            foreach($words as $word){
            $query->where(function ($query) use ($word){
                    $query->orWhereIn('talent_id',Talent::select('id')->where('name', 'like', "%$word%"));
                    $query->orWhere('title', 'like', "%$word%");
                    $query->orWhere('explanation', 'like', "%$word%");
                });
            }
        }

        return $query;
    }

    public function scopeSearchWord($query, $word)
    {
        return $query->where('title', 'like', "%$word%");
    }

    public function scopeSearchWordWithTalentId($query, $talents)
    {
        return $query->orWhereIn('talent_id', $talents);
    }

    public function scopeSearchWithReleaseStatus($query, $release_statuses)
    {
        if (is_array($release_statuses) && optional($release_statuses)[0] !== null){
            $query->where(function($query) use ($release_statuses){
                foreach($release_statuses as $release_status){
                    $query->orWhere('release_status', $release_status);
                }
            });
        }
        return $query;
    }

    public function scopeSearch($query)
    {
        if ($this->getSearchWordInArray()) {
            foreach ($this->getSearchWordInArray() as $word) {
                $query->where(function ($query) use ($word) {
                    $query->where('title', 'like', "%$word%")->orWhere('curator', 'like', "%$word%")->orWhere('id', 'like', "%$word%")->orWhereIn('user_id',User::select('id')->where('name', 'like', "%$word%"));
                });
            }
        }
    }
    //--------------local scope----------------//


    public function getTotalLikesAttribute()
    {
        return $this->likedUsers()->count() + $this->added_like;
    }

    public function getDisplayIdAttribute()
    {
        return 'PR'.sprintf('%05d', $this->id);
    }

    public function getNumberOfDaysLeftAttribute()
    {
        $end_date = new Carbon($this->end_date);
        $today = Carbon::now();
        return $end_date->diffInDays($today);
    }

    // plansの持つ'included_payments_count'の合計値 => 支援者総数
    // scopeGetWithPlansWithInPaymentsCountAndSumPriceを呼んでいないと使えないです。
    public function getPaymentUsersCountAttribute()
    {
        return $this->plans->sum('included_payments_count');
    }

    // plansの持つ'included_payments_sum_price'の合計値 => 支援総金額
    // scopeGetWithPlansWithInPaymentsCountAndSumPriceを呼んでいないと使えないです。
    public function getAchievementAmountAttribute()
    {
        return $this->plans->sum('included_payments_sum_price');
    }

    // 目標金額に対する支援総額の割合
    // scopeGetWithPlansWithInPaymentsCountAndSumPriceを呼んでいないと使えないです。
    public function getAchievementRateAttribute()
    {
        // 金額の達成率の算出
        if ($this->target_amount > 0) {
            return round($this->achievement_amount * 100 / $this->target_amount);
        } else { // ゼロ除算対策
            return 100;
        }
    }

    // 紐づくプランが持つ'included_payments_count'の合計が高い順に並び替えてコレクションにして返す
    // コレクションにしてから呼び出さないと使えない
    public function scopeSortedByPaymentsCount($projects)
    {
        $projectsSortedByPaymentsCount = $projects->get()->sortByDesc(function ($project) {
            return $project->plans->sum('included_payments_count');
        })->values()->all();
        return collect($projectsSortedByPaymentsCount);
    }

    public function scopeSortedByPaymentsSumPrice($projects)
    {
        $projectsSortedByPaymentsSumPrice = $projects->get()->sortByDesc(function ($project) {
            return $project->plans->sum('included_payments_sum_price');
        })->values()->all();
        return collect($projectsSortedByPaymentsSumPrice);
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
    public function changeStatusToRelease(){
        DB::transaction(function () {
            $this->release_status = '掲載中';
            $this->save();
        });
        \Session::flash('flash_message', '掲載状態の変更が完了しました。');
    }

    public function changeStatusToPending(){
        DB::transaction(function () {
            $this->release_status = '承認待ち';
            $this->save();
        });
        \Session::flash('flash_message', '掲載状態の変更が完了しました。');
    }

    public function changeStatusToSendBack(){
        DB::transaction(function () {
            $this->release_status = '差し戻し';
            $this->save();
        });
        \Session::flash('flash_message', '掲載状態の変更が完了しました。');
    }

    public function changeStatusToDefault(){
        DB::transaction(function () {
            $this->release_status = '---';
            $this->save();
        });
        \Session::flash('flash_message', '掲載状態の変更が完了しました。');
    }

    public function changeStatusToUnderSuspension(){
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
            'id',PlanPaymentIncluded::query()->select('plan_id')->whereIn(
            'payment_id',Payment::query()->select('id')->where(
            'user_id', Auth::id()
        )))->get();
        $is_included = false;
        if (!$plans->isEmpty()) {
            $is_included = true;
        }
        return $is_included;
    }

    public function saveProjectImages(array $images): void
    {
        if (!empty($images) && $images[0] !== null){
            $this->projectFiles()->saveMany($images);
        }
    }

    public function saveProjectVideo($projectVideo)
    {
        // ユーザーがURLを入力していないor更新する際にURLが変更されていない場合
        if (optional($projectVideo)->file_url === null || optional($this->projectFiles()->where('file_content_type', 'video_url')->first())->file_url === optional($projectVideo)->file_url) {
            return false;
        // 新規作成の時or更新する際に動画のURLが存在しない場合
        } elseif(optional($this->projectFiles()->where('file_content_type', 'video_url')->first())->file_url === null && optional($projectVideo)->file_url !== null){
            $this->projectFiles()->save($projectVideo);
            // プロジェクト更新時に既に埋め込んでいるURLから別のURLに変更した場合
        } elseif(optional($this->projectFiles()->where('file_content_type', 'video_url')->first())->file_url !== optional($projectVideo)->file_url){
            $this->projectFiles()->where('file_content_type', 'video_url')->first()->delete();
            $this->projectFiles()->save($projectVideo);
        };
    }

    public function deleteProjectImages(): void
    {
        foreach($this->projectFiles as $file){
            if(strpos($file->file_url, 'sampleImage') === false && $file->file_content_type === 'video_url'){
                Storage::delete($file->file_url);
            };
            $file->delete();
        }
    }
}
