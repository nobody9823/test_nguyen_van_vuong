<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'project_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function(ActivityReport $activity_report){
            $activity_report->activityReportImages()->delete();
        });
    }

    // NOTE:scopeGetActivityReportsByCompanyとscopeGetActivityReportsByTalentの処理で、ログインユーザーと同じカンパニー・タレントidの活動報告を取得する処理を記載しているが、この処理は現状必要ない
    // ※return $query->where('project_id', $project_id);  ・・・ 本来はこれだけでも問題ない。
    // しかし、今後の仕様変更によりプロジェクト管理画面を経由せず、個別で活動報告管理画面に画面遷移する事になった場合を見据え、そのまま記載している。
    public function scopeGetActivityReportsByCompany($query)
    {
        return $query->whereIn('project_id', Project::select('id')
                    ->whereIn('talent_id', Talent::select('id')->where('company_id', Auth::id())
        ));
    }

    public function scopeGetActivityReportsByTalent($query)
    {
        return $query->whereIn('project_id', Project::select('id')
                    ->where('talent_id', Auth::id()));
    }

    public function scopeGetActivityReports($query)
    {
        return $query->with('project')->paginate(10);
    }

    public function scopeSearchByArrayWords($query, $words)
    {
        if($words[0] !== ""){
            $query->where( function($query) use ($words){
                foreach($words as $word){
                    $query->where('title', 'like', "%$word%");
                    $query->orWhere('content', 'like', "%$word%");
                }
            });
        }

        return $query;
    }

    public function scopeWithProjectId($query, $project_id)
    {
        if ($project_id !== null){
            $query->where('project_id', $project_id);
        }
        return $query;
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
    public function activityReportImages()
    {
        return $this->hasMany('App\Models\ActivityReportImage');
    }

    public function deleteImages()
    {
        if ($this->activityReportImages){
            foreach($this->activityReportImages as $image){
                $image->deleteImage();
            }
        }
    }
}
