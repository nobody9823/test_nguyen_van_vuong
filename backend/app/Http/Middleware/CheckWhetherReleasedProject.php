<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Project;
use Illuminate\Http\Request;

class CheckWhetherReleasedProject
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
        $project = $request->route()->parameter('project');

        // リダイレクトでアクセスした場合、モデルインスタンスではなく自動でIDに書き換わるのでここでチェック
        if (is_object($project) === false) {
            $project = Project::find($project);
        }
        //projectが自身のものか確認
        if ($project && ($project->release_status !== '掲載中')) {
            abort(403, "このプロジェクトにはアクセスできません。");
        }

        return $next($request);
    }
}
