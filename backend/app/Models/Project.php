<?php

namespace App\Models;

use Auth;
use App\Models\UserProjectLiked;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Storage;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'talent_id',
        'title',
        'greeting_and_introduce',
        'explanation',
        'opportunity',
        'finally',
        'target_amount',
        'start_date',
        'end_date',
    ];

    protected $dates = ['start_date', 'end_date'];

    private int $achievement_amount = 0;
    private int $achievement_rate = 0;
    private int $cheering_users_count = 0;
    private bool $achievement_is_calculated = false;

    public static function boot()
    {
        parent::boot();
        static::deleting(function(Project $project){
            // プロジェクト画像と動画の論理削除
            $project->projectFile()->delete();
            $project->projectTagTagging()->delete();
            // プランのリレーション先も論理削除
            $plan_ids = $project->plans()->pluck('id')->toArray();
            UserPlanBilling::whereIn('plan_id', $plan_ids)->delete();
            Plan::destroy($plan_ids);
            // コメントのリレーション先も論理削除
            $comment_ids = $project->comments()->pluck('id')->toArray();
            Reply::whereIn('comment_id', $comment_ids)->delete();
            Comment::destroy($comment_ids);
            $report_ids = $project->reports()->pluck('id')->toArray();
            ActivityReportImage::whereIn('report_id', $report_ids)->delete();
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

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_project_liked')
            ->using('App\Models\UserProjectLiked')
            ->withTimestamps();
    }

    public function userProjectLiked()
    {
        return $this->hasMany('App\Models\UserProjectLiked');
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
    // FIXME 命名が抽象的すぎるので直したい
    public function scopeGetProjects($query)
    {
        return $query->with('talent')->orderBy('created_at', 'desc')->paginate(10);
    }

    public function scopeGetReleasedProject()
    {
        return $this->where('release_status', '掲載中');
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
        return $query->take($int)->with(['talent', 'projectImages', 'plans', 'activityReports']);
    }

    public function scopeOrdeyByFundingAmount($query)
    {
        return $query
        // projectsテーブルにplans,user_plan_cheeringテーブルを結合する
        ->join('plans', 'projects.id', '=', 'plans.project_id')
        ->join('user_plan_cheering', 'plans.id', '=', 'user_plan_cheering.plan_id')
        // 結合テーブル内のproject_idが同じものは、プランの価格を全て足す。
        ->select('plans.project_id','projects.*',DB::raw('SUM(plans.price) as funding_amount'))
        ->groupBy('plans.project_id')->orderBy('funding_amount','DESC');
    }

    public function scopeOrdeyByNumberOfSupporters($query)
    {
        return $query
        // projectsテーブルにplans,user_plan_cheeringテーブルを結合する
        ->join('plans', 'projects.id', '=', 'plans.project_id')
        ->join('user_plan_cheering', 'plans.id', '=', 'user_plan_cheering.plan_id')
        // 結合テーブル内のplans.project_idが同じものは、その人数を全て足す。
        ->select('plans.project_id','projects.*',DB::raw('count(user_plan_cheering.user_id) as number_of_user'))
        ->groupBy('plans.project_id')
        ->orderBy('number_of_user', 'DESC');
    }

    public function scopeOrdeyByLikedUsers($query)
    {
        return $query->withCount('users')->orderByRaw('users_count + added_like DESC');
    }

    public function scopeOrderByNearlyDeadline($query)
    {
        return $query->orderBy(\DB::raw('abs(datediff(CURDATE(), end_date))'), "ASC");
    }

    public function scopeOrderByNearlyOpen($query)
    {
        return $query->where('start_date', '>', Carbon::now())->orderBy(\DB::raw('abs(datediff(CURDATE(), start_date))'), "ASC");
    }

    public function scopeOnlyCheeringDisplay($query)
    {
        return $query
        ->whereIn('projects.id',Plan::select('project_id')
        ->whereIn('id',UserPlanCheering::select('plan_id')
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

    public function getTotalLikesAttribute()
    {
        return $this->users()->count() + $this->added_like;
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
     * Get number of cheering users
     *
     * @return int
     */
    public function getCheeringUsersCount(): int
    {
        $this->calculateAchieve();
        return $this->cheering_users_count;
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
     * Calculate achievement amount ,achievement rate and number of cheering users
     *
     * @return void
     */
    public function calculateAchieve(): void
    {
        //一回計算されてるならもうしないで返す
        if ($this->achievement_is_calculated) {
            return;
        }

        $plans =  $this->plans()->with('users')->get();
        // 応援プランを支援したユーザーの総数
        $cheering_users_count = 0;
        // 現在の達成額
        $achievement_amount = 0;

        //それぞれのプランの応援人数から支援総額と応援人数の合計を算出
        foreach($plans as $plan) {
            $users_count = count($plan->users);
            $achievement_amount += $plan->price * $users_count;
            $cheering_users_count += $users_count;
        }
        // 金額の達成率の算出
        if ($this->target_amount > 0) {
            $achievement_rate = round($achievement_amount * 100 / $this->target_amount);
        } else { // ゼロ除算対策
            $achievement_rate = 100;
        }

        $this->cheering_users_count = $cheering_users_count;
        $this->achievement_amount = $achievement_amount;
        $this->achievement_rate = $achievement_rate;
    }

    public function releaseProject(){
        $this->release_status = '掲載中';
        return $this->save() ? true : false;
    }

    // プロジェクトの持つプランをログインしているユーザーが支援しているかを確認
    public function isCheering()
    {
        $plans = $this->plans()->with('users')->get();
        $is_cheering = false;
        foreach ($plans as $plan) {
            $result = $plan->users()->find(Auth::id());
            if ($result !== null) {
                $is_cheering = true;
                break;
            }
        }
        return $is_cheering;
    }

    public function saveProjectImages(Request $request): void
    {
        if ($request->images !== null){
            $this->projectImages()->saveMany($request->imagesToArray());
        }
    }

    public function saveProjectVideo($projectVideo)
    {
        // ユーザーがURLを入力していないor更新する際にURLが変更されていない場合
        if (optional($projectVideo)->video_url === null || (optional(optional($this->projectVideo))->video_url === optional($projectVideo)->video_url)) {
            return false;
        // 新規作成の時or更新する際に動画のURLが存在しない場合
        } elseif(optional(optional($this->projectVideo))->video_url === null && optional($projectVideo)->video_url !== null){
            $this->projectVideo()->save($projectVideo);
            // プロジェクト更新時に既に埋め込んでいるURLから別のURLに変更した場合
        } elseif(optional(optional($this->projectVideo))->video_url !== optional($projectVideo)->video_url){
            $this->projectVideo()->delete();
            $this->projectVideo()->save($projectVideo);
        };
    }

    public function deleteProjectImages(): void
    {
        foreach($this->projectImages as $image){
            if(strpos($image->image_url, 'sampleImage') === false){
                Storage::delete($image->image_url);
            };
            $image->delete();
        }
    }
}
