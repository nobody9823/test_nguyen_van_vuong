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
    @if(Request::get('project'))
        <a class="btn btn-sm btn-outline-success ml-4" href={{route($role.'.'.$model.'.index', ['project' => Request::get('project')])}}>プロジェクトを維持したまま検索条件をクリア</a>
    @endif
    <a class="btn btn-sm btn-outline-primary ml-4" href={{route($role.'.'.$model.'.index')}}>すべての検索条件をクリア</a>
</div>
<div class="collapse show" id="collapseSearchFilter">
    @if(Request::get('word'))
    <div class="card-header d-flex align-items-center">
        検索ワード :
        <div class="flex-grow-1">
            【{{ Request::get('word') }}】
        </div>
    </div>
    @endif
    @if($project)
    <div class="card-header d-flex align-items-center">
        プロジェクトタイトル :
        <div class="flex-grow-1">
            【{{ $project->title }}】
        </div>
    </div>
    @endif
    @if(Request::get('job_cd'))
    <div class="card-header d-flex align-items-center">
        処理区分 :
        <div class="flex-grow-1">
            【{{ Request::get('job_cd') }}】
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
</div>
@endif
