<?php

namespace App\Models;

use App\Casts\ImageCast;
use App\Casts\HashMake;
use App\Models\RepliesToSupporterComment;
use Carbon\Carbon;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Talent extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'talents';

    protected $fillable = [
        'name',
        'email',
        'password',
        'image_url',
        'company_id',
        'recruitment_status',
        'employment_status',
        'evaluation_status',
        'hourly_wage',
        'resignation_status',
    ];

    protected $casts = [
        'image_url' => ImageCast::class,
        'password' => HashMake::class,
    ];

    public static function boot()
    {
        parent::boot();
        static::deleting(function(Talent $talent){
            // プロジェクトIDの取得
            $project_ids = $talent->projects()->pluck('id')->toArray();
            ProjectImage::whereIn('project_id', $project_ids)->delete();
            ProjectVideo::whereIn('project_id', $project_ids)->delete();
            UserProjectLiked::whereIn('project_id', $project_ids)->delete();
            // プランIDの取得と削除
            $plan_ids = Plan::whereIn('project_id', $project_ids)->pluck('id')->toArray();
            UserPlanCheering::whereIn('plan_id', $plan_ids)->delete();
            Option::whereIn('plan_id', $plan_ids)->delete();
            Plan::destroy($plan_ids);
            // 活動報告IDの取得と削除
            $activity_report_ids = ActivityReport::whereIn('project_id', $project_ids)->pluck('id')->toArray();
            ActivityReportImage::whereIn('activity_report_id', $activity_report_ids)->delete();
            ActivityReport::destroy($activity_report_ids);
            // 支援者コメントIDの取得と削除
            RepliesToSupporterComment::where('talent_id', $talent->id)
                                    ->update(array('deleted_at' => Carbon::now()));
            $supporter_comment_ids = supporterComment::whereIn('project_id', $project_ids)->pluck('id')->toArray();
            UserSupporterCommentLiked::whereIn('supporter_comment_id', $supporter_comment_ids)->delete();
            SupporterComment::destroy($supporter_comment_ids);
            // プロジェクトの削除
            Project::destroy($project_ids);

            // シフト管理IDの取得と削除
            $workShift_ids = $talent->workShifts()->pluck('id')->toArray();
            WorkAttendance::whereIn('work_shift_id', $workShift_ids)->delete();
            WorkShift::destroy($workShift_ids);
        });
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }

    public function workShifts()
    {
        return $this->hasMany(WorkShift::class);
    }

    public function supporterComment()
    {
        return $this->belongsToMany('App\Models\SupporterComment', 'App\Models\RepliesToSupporterComment');
    }


    //--------------- local scopes -------------
    // FIXME 命名が抽象的すぎるので直したい
    public function scopeGetTalents()
    {
        return $this->orderBy('created_at', 'desc')->paginate(10);
    }

    public function scopeGetTalentsByCompany()
    {
        return $this->where('company_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
    }

    public function scopePluckNameAndId()
    {
        return $this->pluck('name', 'id');
    }

    public function scopeSearchWords($query, $words)
    {
        if ($words[0] !== "") {
            foreach ($words as $word) {
                $query->where(function ($query) use ($word) {
                    $query->where('name', 'like', "%${word}%");
                    $query->orWhere('email', 'like', "%${word}%");
                });
            }
        }
        return $query;
    }

    public function scopeSearchWord($query, $word)
    {
        return $query->where('name', 'like', $word);
    }

    public function scopeSearchByWordWithCompanyId($query, $company)
    {
        return $query->orWhereIn('company_id', $company);
    }

    //--------------- local scopes -------------


    //--------------- functions -------------
    public function deleteImageIfSample(): void
    {
        if (strpos($this->image_url, 'sampleImage') === false) {
            Storage::delete($this->image_url);
        };
    }
    //--------------- functions -------------
}
