<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Project\ProjectService;
use App\Http\Requests\MyProjectRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\Plan;
use App\Models\Tag;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class MyProjectController extends Controller
{

    protected $project_service;

    protected $user;

    public function __construct(ProjectService $project_service)
    {
        $this->middleware(function ($request, $next) {
            $this->user = \Auth::user();
            return $next($request);
        });

        $this->project_service = $project_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = $this->user->projects()->get();
        return view('user.my_project.index', ['projects' => $projects->load('projectFiles')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::pluck('name', 'id');

        $project = $this->user->projects()->save(Project::initialize());

        $project->projectFiles()->save(ProjectFile::initialize());

        return view('user.my_project.edit', ['project' => $project, 'tags' => $tags]);
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
    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
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
        DB::beginTransaction();
        try {
            $project->fill($request->all())->save();

            $this->user->identification->fill($request->all())->save();

            $this->user->profile->fill($request->all())->save();

            $this->user->address->fill($request->all())->save();

            $this->project_service->attachTags($project, $request);

            $this->project_service->saveImages($project, $request);

            $this->project_service->saveVideoUrl($project, $request);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect()->action([MyProjectController::class, 'edit'], ['project' => $project])->with(['flash_message' => 'プロジェクトが更新されました。']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
