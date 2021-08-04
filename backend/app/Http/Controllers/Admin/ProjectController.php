<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LikeCalculationRequest;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Plan;
use App\Models\Tag;
use App\Models\User;
use App\Models\Curator;
use App\Models\Project;
use App\Models\ProjectFile;
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
        $projects = Project::search($role = "admin")
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
            $projects = $projects->with('curator')->paginate(10);
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
        $curators = Curator::pluckNameAndId();
        $tags = Tag::pluckNameAndId();
        return view('admin.project.create', [
            'tags' => $tags,
            'users' => $users,
            'curators' => $curators,
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
            $project->tags()->attach($request->tags);
            $project->saveProjectImages($request->imagesToArray());
            $project->saveProjectVideo($request->projectVideo());
            $project->curator()->associate(Curator::find($request->curator_id))->save();
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
        $project = $project::where('projects.id', $project->id)->getWithPaymentsCountAndSumPrice()
            ->with('projectFiles', 'plans', 'reports')->first();
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
        $curators = Curator::pluckNameAndId();
        $tags = Tag::pluckNameAndId();
        $project_tags = $project->tags->pluck('id')->toArray();
        $projectImages = $project->projectFiles()->where('file_content_type', 'image_url')->get();
        $projectVideo = $project->projectFiles()->where('file_content_type', 'video_url')->first();

        return view('admin.project.edit', [
            'project' => $project,
            'tags' => $tags,
            'project_tags' => $project_tags,
            'users' => $users,
            'projectImages' => $projectImages,
            'projectVideo' => $projectVideo,
            'curators' => $curators,
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
            $project->tags()->sync($request->tags);
            $project->saveProjectImages($request->imagesToArray());
            $project->saveProjectVideo($request->projectVideo());
            $project->curator()->associate(Curator::find($request->curator_id))->save();
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
            $project->deleteProjectFiles();
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
        return view('admin.project.preview', ['project' => $project,]);
    }

    /**
     * @param  ProjectImage  $projectImage
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteFile(ProjectFile $project_file)
    {
        $project_file->deleteFile();
        return response()->json('success');
    }

    public function uploadEditorFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);
        $path = $request->file('file')->store('public/image');
        return ['location' => Storage::url($path)];
    }

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

    public function outputPurchasesListToCsv(Project $project)
    {
        //ページ遷移させずにダウンロードさせるためにstreamed responseとして返す
        $response = new StreamedResponse(function () use ($project) {
            $project->load(['payments' => function ($query) {
                $query->with(['user.profile', 'user.address', 'includedPlans', 'paymentToken']);
            }]);
            $payments = $project->payments;

            //保存しない形でファイルのアウトプットを作成（良く分かってないので文章変です。）
            $stream = fopen('php://output', 'w');

            $payment_csv_head = ['支援ID', '支援者名', 'メールアドレス', 'お届け先', '上乗せ課金額', '支援総額', '支援日'];
            mb_convert_variables('SJIS', 'UTF-8', $payment_csv_head);
            fputcsv($stream, $payment_csv_head);

            //プロジェクト詳細画面出力情報に合わせてデータを作成
            foreach ($payments as $payment) {
                $payment_data = [
                    $payment->paymentToken->token,
                    $payment->user->profile->last_name . $payment->user->profile->first_name,
                    $payment->user->email,
                    $payment->user->address->postal_code . $payment->user->address->prefecture . $payment->user->address->city . $payment->user->address->block . $payment->user->address->building,
                    $payment->added_payment_amount,
                    $payment->price,
                    $payment->created_at,
                ];

                mb_convert_variables('SJIS', 'UTF-8', $payment_data);
                fputcsv($stream, $payment_data);

                $included_plan_csv_head = ['支援リターン名', 'リターン金額', '個数', '合計'];
                mb_convert_variables('SJIS', 'UTF-8', $included_plan_csv_head);
                fputcsv($stream, $included_plan_csv_head);

                $included_plan_data = [];

                foreach ($payment->includedPlans as $plan) {
                    $included_plan_data[] = [
                        $plan->title,
                        $plan->price,
                        $plan->pivot->quantity,
                        $plan->price * $plan->pivot->quantity,
                    ];
                }

                foreach ($included_plan_data as $included_plan_low) {
                    mb_convert_variables('SJIS', 'UTF-8', $included_plan_low);
                    fputcsv($stream, $included_plan_low);
                }
            }

            fclose($stream);
        });
        //レスポンスにヘッダーつけて返す
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename=' . $project->title . '_purchases_list.csv');
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
