{{--
    検索条件を出すコンポーネント
    必要引数
    role = 認証ガードを指定
    model = 対象モデルを指定
    --}}
@if(Request::query())
<div class="card-header">
    <span style="cursor: pointer;" data-toggle="collapse" data-target="#collapseSearchFilter" aria-expanded="false"
        aria-controls="collapseFilter">
        検索条件▼
    </span>
    @if($project)
        <a class="btn btn-sm btn-outline-success ml-4" href={{route($role.'.'.$model.'.index', ['project' => $project->id])}}>プロジェクトを維持したまま検索条件をクリア</a>
    @endif
    <a class="btn btn-sm btn-outline-primary ml-4" href={{route($role.'.'.$model.'.index')}}>すべての検索条件をクリア</a>
</div>
<div class="collapse show" id="collapseSearchFilter">
    @if($project)
    <div class="card-header d-flex align-items-center">
        プロジェクトタイトル :
        <div class="flex-grow-1">
            【{{ $project->title }}】<a class="btn btn-sm btn-outline-secondary ml-4" href={{route($role.'.project.index', ['project' => $project->id])}}>{{ $project->display_id }}</a>
        </div>
    </div>
    @endif
    @if(Request::get('release_statuses'))
    <div class="card-header d-flex align-items-center">
        掲載状態 :
        <div class="flex-grow-1">
            @foreach(Request::get('release_statuses') as $release_status)
            【{{ ProjectReleaseStatus::fromValue($release_status) }}】
            @endforeach
        </div>
    </div>
    @endif
    @if(Request::get('release_period'))
    <div class="card-header d-flex align-items-center">
        掲載期間 :
        <div class="flex-grow-1">
            【{{ App\Enums\ProjectReleasePeriod::fromValue(Request::get('release_period')) }}】
        </div>
    </div>
    @endif
    @if(Request::get('job_cd'))
    <div class="card-header d-flex align-items-center">
        処理区分 :
        <div class="flex-grow-1">
            【{{ PaymentJobCd::fromKey(Request::get('job_cd')) }}】
        </div>
    </div>
    @endif
    @if(Request::get('sort_type'))
    <div class="card-header d-flex align-items-center">
        並び替え条件 :
        <div class="flex-grow-1">
            【{{ config('sort')[Request::get('sort_type')]}}】
        </div>
    </div>
    @endif
    @if(Request::get('word'))
    <div class="card-header d-flex align-items-center">
        検索ワード :
        <div class="flex-grow-1">
            【{{ Request::get('word') }}】
        </div>
    </div>
    @endif
    @if(Request::get('end_date_from') || Request::get('end_date_to'))
    <div class="card-header d-flex align-items-center">
        掲載終了日 :
        <div class="flex-grow-1">
            @if(Request::get('end_date_from'))
            【{{ Request::get('end_date_from') }}】から
            @endif
            @if(Request::get('end_date_to'))
            【{{ Request::get('end_date_to') }}】まで
            @endif
        </div>
    </div>
    @endif
</div>
@endif
