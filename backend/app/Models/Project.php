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
        'start_date',
        'end_date',
    ];

    protected $dates = ['start_date', 'end_date'];

    private int $achievement_amount = 0;
    private int $achievement_rate = 0;
    private int $included_users_count = 0;
    private bool $achievement_is_calculated = false;

    public static function boot()
    {
        parent::boot();
        static::deleting(function(Project $project){
            // プロジェクト画像と動画の論理削除
            $project->projectFiles()->delete();
            $project->projectTagTagging()->delete();
            // プランのリレーション先も論理削除
            $plan_ids = $project->plans()->pluck('id')->toArray();
            $payment_ids = Payment::whereIn('plan', $plan_ids)->pluck('id');
            PlanPaymentIncluded::whereIn('payment_id', $payment_ids)->delete();
            MessageContent::whereIn('payment_id', $payment_ids)->delete();
            Payment::destroy($payment_ids)->delete();
            Plan::destroy($plan_ids);
            // コメントのリレーション先も論理削除
            $comment_ids = $project->comments()->pluck('id')->toArray();
            Reply::whereIn('comment_id', $comment_ids)->delete();
            Comment::destroy($comment_ids);
            $report_ids = $project->reports()->pluck('id')->toArray();
            Report::destroy($report_ids);
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

    public function scopeTakeWithRelations($query, $int)
    {
        return $query->take($int)->with(['projectFiles', 'plans', 'plans.includedPayments', 'plans.includedPayments.user', 'reports']);
    }

    public function scopeOrdeyByFundingAmount($query)
    {
        return $query
        // projectsテーブルにplans,user_plan_billingテーブルを結合する
        ->join('plans', 'projects.id', '=', 'plans.project_id')
        ->join('user_plan_billing', 'plans.id', '=', 'user_plan_billing.plan_id')
        // 結合テーブル内のproject_idが同じものは、プランの価格を全て足す。
        ->select('plans.project_id','projects.*',DB::raw('SUM(plans.price) as funding_amount'))
        ->groupBy('plans.project_id')->orderBy('funding_amount','DESC');
    }

    public function scopeOrdeyByNumberOfSupporters($query)
    {
        return $query
        // projectsテーブルにplans,user_plan_billingテーブルを結合する
        ->join('plans', 'projects.id', '=', 'plans.project_id')
        ->join('user_plan_billing', 'plans.id', '=', 'user_plan_billing.plan_id')
        // 結合テーブル内のplans.project_idが同じものは、その人数を全て足す。
        ->select('plans.project_id','projects.*',DB::raw('count(user_plan_billing.user_id) as number_of_user'))
        ->groupBy('plans.project_id')
        ->orderBy('number_of_user', 'DESC');
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
            foreach($release_statuses as $release_status){
                $query->orWhere(function($query) use ($release_status){
                    $query->where('release_status', $release_status);
                });
            }
        }
        return $query;
    }

    public function scopeSearch($query)
    {
        if ($this->getSearchWordInArray()) {
            foreach ($this->getSearchWordInArray() as $word) {
                $query->where(function ($query) use ($word) {
                    $query->Where('title', 'like', "%$word%")->orWhereIn('user_id',User::select('id')->where('name', 'like', "%$word%"));
                });
            }
        }
    }
    //--------------local scope----------------//


    public function getTotalLikesAttribute()
    {
        return $this->likedUsers()->count() + $this->added_like;
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

    /**
     * Get number of Billing users
     *
     * @return int
     */
    public function getBillingUsersCount(): int
    {
        $this->calculateAchieve();
        return $this->included_users_count;
    }

    /**
     * Get achievement amount of project
     *
     * @return int
     */
    public function getAchievementAmount(): int
    {
        $this->calculateAchieve();
        return $this->achievement_amount;
    }

    /**
     * Get achievement rate of project
     *
     * @return int
     */
    public function getAchievementRate(): int
    {
        $this->calculateAchieve();
        return $this->achievement_rate;
    }

    /**
     * Calculate achievement amount ,achievement rate and number of Billing users
     *
     * @return void
     */
    public function calculateAchieve(): void
    {
        //一回計算されてるならもうしないで返す
        if ($this->achievement_is_calculated) {
            return;
        }

        $plans =  $this->plans()->withCount('includedPayments')->get();
        // 応援プランを支援したユーザーの総数
        $included_users_count = 0;
        // 現在の達成額
        $achievement_amount = 0;

        //それぞれのプランの応援人数から支援総額と応援人数の合計を算出
        foreach($plans as $plan) {
            $achievement_amount += $plan->price * $plan->included_payments_count;
            $included_users_count += $plan->included_payments_count;
        }
        // 金額の達成率の算出
        if ($this->target_amount > 0) {
            $achievement_rate = round($achievement_amount * 100 / $this->target_amount);
        } else { // ゼロ除算対策
            $achievement_rate = 100;
        }

        $this->included_users_count = $included_users_count;
        $this->achievement_amount = $achievement_amount;
        $this->achievement_rate = $achievement_rate;
    }

    public function releaseProject(){
        $this->release_status = '掲載中';
        return $this->save() ? true : false;
    }

    // プロジェクトの持つプランをログインしているユーザーが支援しているかを確認
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
