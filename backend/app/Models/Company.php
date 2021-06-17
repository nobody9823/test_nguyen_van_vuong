<?php

namespace App\Models;

use App\Casts\ImageCast;
use App\Casts\HashMake;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Company extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'image_url',
        'contract_status',
        'contract_date',
        'cancellation_date',
        'remarks',
    ];

    protected $casts = [
        'image_url' => ImageCast::class,
        'password' => HashMake::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function(Company $company){
            // タレントIDの取得
            $talent_ids = $company->talents()->pluck('id')->toArray();
            // プロジェクトIDの取得とリレーション先のモデルの削除
            $project_ids = Project::whereIn('talent_id', $talent_ids)->pluck('id')->toArray();
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
            RepliesToSupporterComment::whereIn('talent_id', $talent_ids)
                                    ->update(array('deleted_at' => Carbon::now()));
            $supporter_comment_ids = supporterComment::whereIn('project_id', $project_ids)->pluck('id')->toArray();
            UserSupporterCommentLiked::whereIn('supporter_comment_id', $supporter_comment_ids)->delete();
            SupporterComment::destroy($supporter_comment_ids);
            // プロジェクトの削除
            Project::destroy($project_ids);

            // シフト管理IDの取得と削除
            $workShift_ids = WorkShift::whereIn('talent_id', $talent_ids)->pluck('id')->toArray();
            WorkAttendance::whereIn('work_shift_id', $workShift_ids)->delete();
            WorkShift::destroy($workShift_ids);

            // タレントの削除
            Talent::destroy($talent_ids);
            $company->temporaryTalents()->delete();
        });
    }

    public function talents()
    {
        return $this->hasMany('App\Models\Talent');
    }



    //--------------- local scopes -------------
    public function temporaryTalents()
    {
        return $this->hasMany('App\Models\TemporaryTalent');
    }

    public function scopeGetCompanies()
    {
        return $this->orderBy('id', 'desc')->paginate(10);
    }

    public function scopeGetAllCompanies()
    {
        return $this->get();
    }

    public function scopeSearchWords($query, $words)
    {
        if ($words[0] !== "") {
            $query->where(function ($company) use ($words) {
                foreach ($words as $word) {
                    $company->where('name', 'like', "%$word%");
                    $company->orWhere('email', 'like', "%$word%");
                }
            });
        }

        return $query;
    }

    public function scopeSearchCompaniesToArray($query, $word): array
    {
        return $query->where('name', 'like', "%$word%")->pluck('id')->toArray();
    }

    public function releaseCompany(){
        $this->is_released = true;
        $this->save();
        return "success";
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
