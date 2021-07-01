{{--
    検索条件を出すコンポーネント
    必要引数
    role = 認証ガードを指定
    model = 対象モデルを指定
    --}}
@if(Request::get('word') || Request::get('sort_type'))
<div class="card-header">
    <span style="cursor: pointer;" data-toggle="collapse" data-target="#collapseSearchFilter" aria-expanded="false"
        aria-controls="collapseFilter">
        検索条件▼
    </span>
    <a class="btn btn-sm btn-outline-info ml-4" href={{route($role.'.'.$model.'.index')}}>検索条件をクリア</a>
</div>
<div class="collapse" id="collapseSearchFilter">
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
