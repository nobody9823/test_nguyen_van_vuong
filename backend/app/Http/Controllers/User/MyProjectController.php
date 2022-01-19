<?php

namespace App\Http\Controllers\User;

use App\Actions\CardPayment\CardPaymentInterface;
use App\Http\Controllers\Controller;
use App\Services\Project\ProjectService;
use App\Http\Requests\MyProjectRequest;
use App\Http\Requests\AxiosUploadFileRequest;
use App\Models\Identification;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\Tag;
use App\Models\Payment;
use App\Notifications\MyProjectAppliedMail;
use App\Services\View\EditMyProjectTabService;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Storage;
use Log;

class MyProjectController extends Controller
{
    protected $project_service;

    protected $user;

    protected $my_project_tab_service;

    public function __construct(
        ProjectService $project_service,
        EditMyProjectTabService $my_project_tab_service,
        CardPaymentInterface $card_payment_interface
    ) {
        $this->middleware(function ($request, $next) {
            $this->user = \Auth::user();
            return $next($request);
        });

        $this->project_service = $project_service;

        $this->my_project_tab_service = $my_project_tab_service;

        $this->card_payment = $card_payment_interface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bank_account = Auth::user()->identification->bank_id
            ? $this->card_payment->getBankAccount(Auth::user()->identification->bank_id)
            : 'null';
        $projects = $this->user->projects()->with(
            'projectFiles',
            'plans',
            'tags',
            'user',
            'user.profile',
            'user.address',
            'user.identification'
        )->get();

        return view('user.my_project.index', [
            'projects' => $projects,
            'bank_account' => $bank_account
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = $this->user->projects()->save(Project::initialize());

        return redirect()->action([MyProjectController::class, 'edit'], ['project' => $project])->with('attention_message', '※申請には本人確認が必須となります。お早めにご記入ください。');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    // NOTICE こちらのshowでキャンプファイアのダッシュボード的な扱いになるかと思います。
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $this->authorize('checkOwnProject', $project);
        $bank_account = Auth::user()->identification->bank_id
            ? $this->card_payment->getBankAccount(Auth::user()->identification->bank_id)
            : 'null';
        $project->getLoadIncludedPaymentsCountAndSumPrice()
            ->load('plans', 'tags', 'user', 'user.profile', 'user.address', 'user.identification')
            ->loadCount(['reports', 'plans', 'comments']);
        $not_read_message_count = $project->payments()->withCountNotRead("実行者")->get()->sum('message_contents_count');

        return view(
            'user.my_project.show',
            [
                'project' => $project,
                'bank_account' => $bank_account,
                'not_read_message_count' => $not_read_message_count,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $this->authorize('checkOwnProjectWithPublishedStatus', $project);
        $tags = Tag::pluck('name', 'id');

        return view('user.my_project.edit', ['project' => $project, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MyProjectRequest $request, Project $project)
    {
        $this->authorize('checkOwnProjectWithPublishedStatus', $project);
        DB::beginTransaction();
        try {
            $project->fill($request->all())->save();

            $this->user->identification->fill($request->all())->save();

            $this->user->profile->fill($request->all())->save();

            $this->user->address->fill($request->all())->save();

            $this->project_service->attachTags($project, $request);

            $this->project_service->saveVideoUrl($project, $request);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        if ($request->current_tab === 'identification') {
            return redirect()->action([MyProjectController::class, 'index'])->with(['flash_message' => 'プロジェクトが更新されました。']);
        } else {
            return redirect()->action([MyProjectController::class, 'edit'], ['project' => $project, 'next_tab' => $this->my_project_tab_service->getNextTab($request->current_tab)])->with(['flash_message' => 'プロジェクトが更新されました。']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        return $project->delete() ?
            redirect()->action([MyProjectController::class, 'index'])->with(['flash_message' => 'プロジェクトが削除されました。']) :
            redirect()->action([MyProjectController::class, 'index'])->withErrors('プロジェクトの削除に失敗しました。');
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
        return ['location' => asset(Storage::url($path))];
    }

    public function uploadProjectImage(Project $project, ProjectFile $project_file = null, AxiosUploadFileRequest $request)
    {
        if (!is_null($project_file)) {
            $this->authorize('checkOwnProjectFiles', $project_file);
        } else {
            $this->authorize('checkOwnProjectWithPublishedStatus', $project);
        }
        $this->project_service->saveProjectImage($project, $project_file, $request);

        session()->flash('flash_message', 'スライド画像の更新が完了しました。');
        return response()->json([
            'status' => 200,
            'redirect_url' => route('user.my_project.project.edit', ['project' => $project, 'next_tab' => 'visual']),
        ], 200);
    }

    public function apply(Project $project)
    {
        try {
            $project->release_status = '承認待ち';
            $project->update();
            Auth::user()->notify(new MyProjectAppliedMail($project));
            return redirect()->action([MyProjectController::class, 'index'], ['projects' => $this->user->projects()->get()->load('projectFiles')])->with(['flash_message' => 'プロジェクトの申請が完了しました。']);
        } catch (Exception $e) {
            Log::alert($e->getMessage(), $e->getTrace());
            throw $e;
        }
    }

    public function uploadProject(MyProjectRequest $request, Project $project)
    {
        DB::beginTransaction();
        try {
            $project->fill($request->all())->save();
            $this->user->identification->fill($request->all())->save();
            $this->user->profile->fill($request->all())->save();
            $this->user->address->fill($request->all())->save();
            $this->project_service->attachTags($project, $request);
            $this->project_service->saveVideoUrl($project, $request);
            DB::commit();
            return response()->json(['result' => true]);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return response()->json(['result' => false]);
        }
    }

    public function rewardSample()
    {
        return view('user.my_project.reward_sample', ['project' => null]);
    }

    public function rewardPreview(Project $project)
    {
        $this->authorize('checkOwnProject', $project);
        return view('user.my_project.reward_sample', ['project' => $project]);
    }
}
