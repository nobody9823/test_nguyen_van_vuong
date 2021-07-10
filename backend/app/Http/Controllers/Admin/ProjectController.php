<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LikeCalculationRequest;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Plan;
use App\Models\Tag;
use App\Models\User;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Project::search()
        ->searchWithReleaseStatus($request->release_statuses)
        ->sortBySelected($request->sort_type);

        //リレーション先OrderBy
        if ($request->sort_type === 'user_name_asc') {
            $projects = $projects->get()->sortBy('user.name')->paginate(10);
        } elseif ($request->sort_type === 'user_name_desc') {
            $projects = $projects->get()->sortByDesc('user.name')->paginate(10);
        } elseif ($request->sort_type === 'liked_users_count_asc') {
            $projects = $projects->get()->sortBy(function ($project, $key) {
                return $project->total_likes;
            })->paginate(10);
        } elseif ($request->sort_type === 'liked_users_count_desc') {
            $projects = $projects->get()->sortByDesc(function ($project, $key) {
                return $project->total_likes;
            })->paginate(10);
        } else {
            $projects = $projects->paginate(10);
        }
        return view('admin.project.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluckNameAndId();
        $tags = Tag::pluckNameAndId();
        return view('admin.project.create', [
            'tags' => $tags,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request, Project $project)
    {
        DB::beginTransaction();
        try {
            $project->fill($request->all())->save();
            $project->projectTagTagging()->saveMany($request->tagsToArray());
            $project->saveProjectImages($request->imagesToArray());
            $project->saveProjectVideo($request->projectVideo());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::alert($e);
            return redirect()->back()->withErrors('プロジェクトの作成に失敗しました。管理会社に連絡をお願いします。');
        }

        return redirect()->action(
            [PlanController::class, 'create'],
            ['project' => $project, 'plans' => $project->plans]
        )->with('flash_message', 'プロジェクト作成が成功しました。リターンを作成してください。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project = $project::where('projects.id',$project->id)->getWithPaymentsCountAndSumPrice()
        ->with('projectFiles','plans','reports')->first();
        return view('admin.project.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $users = User::pluckNameAndId();
        $tags = Tag::pluckNameAndId();
        $projectTags = $project->tags->pluck('id')->toArray();
        $projectImages = $project->projectFiles()->where('file_content_type', 'image_url')->get();
        $projectVideo = $project->projectFiles()->where('file_content_type', 'video_url')->first();

        return view('admin.project.edit', [
            'project' => $project,
            'tags' => $tags,
            'projectTags' => $projectTags,
            'users' => $users,
            'projectImages' => $projectImages,
            'projectVideo' => $projectVideo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        DB::beginTransaction();
        try {
            $project->fill($request->all())->save();
            $project->projectTagTagging()->saveMany($request->tagsToArray());
            $project->saveProjectImages($request->imagesToArray());
            $project->saveProjectVideo($request->projectVideo());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::alert($e);
            return redirect()->back()->withErrors('プロジェクトの更新に失敗しました。管理会社に連絡をお願いします。');
        }
        return redirect()->action([ProjectController::class, 'index'])->with('flash_message', '更新が成功しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // FIXME #372 ソフトデリートする
    public function destroy(Project $project)
    {
        DB::beginTransaction();
        try {
            $project->deleteProjectImages();
            $project->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::alert($e);
            return redirect()->back()->withErrors('プロジェクトの削除に失敗しました。管理会社に連絡をお願いします。');
        }
        return redirect()->action([ProjectController::class, 'index'])->with('flash_message', '削除が成功しました。');
    }

    /**
     * Display preview of the project
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function preview(Project $project)
    {
        $plans = $project->plans;
        return view('admin.project.preview', [
            'project' => $project,
            'plans' => $plans,
        ]);
    }

    /**
     * @param  ProjectImage  $projectImage
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    // FIXME #372 ソフトデリートする
    // public function deleteImage(ProjectImage $projectImage)
    // {
    //     Storage::delete($projectImage->image_url);
    //     $projectImage->delete();
    //     return response()->json('success');
    // }

    /**
     * @param  Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    // public function search(SearchRequest $request)
    // {
    //     $projects = Project::SearchByArrayWords($request->getArrayWords())
    //                         ->searchWithReleaseStatus($request->release_statuses)
    //                         ->getProjects();

    //     return view('admin.project.index', [
    //         'projects' => $projects,
    //     ]);
    // }

    // /**
    //  * @param  Project  $project
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function release(Project $project)
    // {
    //     return $project->changeStatusToRelease() ?
    //                 response()->json('success') : '';
    // }

    public function operate_projects(Request $request)
    {
        //今後も操作を増やせるように実装
        if ($request->project_id) {
            $this->changeStatus($request);
        }
        return redirect()->back();
    }

    /**
     * @param  Project  $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus($request)
    {
        $projects = Project::whereIn('id', $request->project_id)->get();
        //ステータスが指定されていなかったら何もしない
        if (!$request->change_status) {
            \Session::flash('error', '掲載状態を選択してください。');
            return;
        }

        //処理回数的にswitch->foreachが一番少なくて済むはず
        switch ($request->change_status) {
            case '---':
                foreach ($projects as $project) {
                    $project->changeStatusToDefault();
                }
                break;
            case '承認待ち':
                foreach ($projects as $project) {
                    $project->changeStatusToPending();
                }
                break;
            case '掲載中':
                foreach ($projects as $project) {
                    $project->changeStatusToRelease();
                }
                break;
            case '掲載停止中':
                foreach ($projects as $project) {
                    $project->changeStatusToUnderSuspension();
                }
                break;
            case '差し戻し':
                foreach ($projects as $project) {
                    $project->changeStatusToSendBack();
                }
                break;
            default:
                break;
        }
        return;
    }

    public function output_cheering_users_to_csv(Project $project)
    {
        //ページ遷移させずにダウンロードさせるためにstreamed responseとして返す
        $response = new StreamedResponse(function () use ($project) {
            $project->load('plans', 'plans.users');
            $data = [];
            $plans = $project->plans;
            //プロジェクト詳細画面出力情報に合わせてデータを作成
            foreach ($plans as $plan) {
                foreach ($plan->users as $user) {
                    foreach ($user->userAddresses as $user_address) {
                        $data[] = [
                        $user->name,
                            $user->email,
                            $plan->title,
                            $plan->price,
                            $user->pivot->created_at,
                            $plan->estimated_return_date,
                            $user_address->address,
                        ];
                    }
                }
            }

            //保存しない形でファイルのアウトプットを作成（良く分かってないので文章変です。）
            $stream = fopen('php://output', 'w');
            $csv_head = ['支援者名', 'メールアドレス', '支援リターン名', '支援額', '支援日', 'お返し予定日', '住所'];
            //カラムとかデータを文字コード変換してさっき開いたファイルに挿入
            mb_convert_variables('SJIS', 'UTF-8', $csv_head);
            fputcsv($stream, $csv_head);
            foreach ($data as $low) {
                mb_convert_variables('SJIS', 'UTF-8', $low);
                fputcsv($stream, $low);
            }
            fclose($stream);
        });
        //レスポンスにヘッダーつけて返す
        $project_title = $project->title;
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', "attachment; filename=cheering_user_list_${project_title}.csv");
        return $response;
    }

    public function approved(Project $project)
    {
        if ($project->release_status === "承認待ち" || $project->release_status === "掲載停止中") {
            $project->release_status = "掲載中";
            return $project->save() ?
                redirect()->back()->with('flash_message', "掲載しました。") :
                redirect()->back()->withErrors('掲載に失敗しました。');
        }
        return redirect()->back()->withErrors('掲載に失敗しました。');
    }

    public function sendBack(Project $project)
    {
        if ($project->release_status === "承認待ち") {
            $project->release_status = "差し戻し";
            return $project->save() ?
            redirect()->back()->with('flash_message', "差し戻しが完了しました。") :
            redirect()->back()->withErrors('差し戻しに失敗しました。');
        }
        redirect()->back()->withErrors('差し戻しに失敗しました。');
    }

    public function underSuspension(Project $project)
    {
        if ($project->release_status === "掲載中") {
            $project->release_status = "掲載停止中";
            return $project->save() ?
            redirect()->back()->with('flash_message', "掲載停止しました。") :
            redirect()->back()->withErrors('掲載停止に失敗しました。');
        }
        redirect()->back()->withErrors('掲載停止に失敗しました。');
    }

    // public function incrementLikes(LikeCalculationRequest $request, Project $project)
    // {
    //     $project->added_like += $request->add_point;
    //     $project->save();
    //     return response()->json([
    //         'result' => 'success',
    //         'total_likes' => $project->total_likes,
    //     ]);
    // }

    // public function decrementLikes(LikeCalculationRequest $request, Project $project)
    // {
    //     $project->added_like -= $request->sub_point;
    //     $project->save();
    //     return response()->json([
    //         'result' => 'success',
    //         'total_likes' => $project->total_likes,
    //     ]);
    // }
}
