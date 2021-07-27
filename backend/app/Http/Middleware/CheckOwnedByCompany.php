<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOwnedByCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // これ超強引です。時短目的のため、route全体に一つのmiddlwwareで対処しています。速度自体はそこまで変わらないです。
        // 毎回middlewareを通すのはよろしくないですが、分類するのは時間がある際になる。
        $project = $request->route()->parameter('project');
        $project_image = $request->route()->parameter('project_image');
        $plan = $request->route()->parameter('plan');
        $activity_report = $request->route()->parameter('activity_report');
        $activity_report_image = $request->route()->parameter('activity_report_image');
        $supporter_comment = $request->route()->parameter('supporter_comment');
        $replies_to_supporter_comment = $request->route()->parameter('replies_to_supporter_comment');

        if ($project) {
            //projectが自社のものか確認
            if (Auth::id() !== $project->talent->company_id) {
                abort(403, "アクセス権限がありません。");
            }
            //planが自社のものか確認
            if ($plan && (Auth::id() !== $plan->project->talent->company_id)) {
                abort(403, "アクセス権限がありません。");
            }
            //activity_reportが自社のものか確認
            if ($activity_report && (Auth::id() !== $activity_report->project->talent->company_id)) {
                abort(403, "アクセス権限がありません。");
            }
        }
        //project_imageが自社のものか確認
        if ($project_image && (Auth::id() !== $project_image->project->talent->company_id)) {
            abort(403, "アクセス権限がありません。");
        }
        //activity_report_imageが自社のものか確認
        if ($activity_report_image && (Auth::id() !== $activity_report_image->activity_report->project->talent->company_id)) {
            abort(403, "アクセス権限がありません。");
        }
        //supporter_commentが自社のものか確認
        if ($supporter_comment && (Auth::id() !== $supporter_comment->project->talent->company_id)) {
            abort(403, "アクセス権限がありません。");
        }
        //replies_to_supporter_commentが自社のものか確認
        if ($replies_to_supporter_comment && (Auth::id() !== $replies_to_supporter_comment->supporterComment->project->talent->company_id)) {
            abort(403, "アクセス権限がありません。");
        }
        return $next($request);
    }
}
