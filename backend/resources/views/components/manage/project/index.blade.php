@extends($role.'.layouts.base')

@section('title', 'プロジェクト一覧')

<!-- 公開非公開ボタン -->
@section('css')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
    rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.min.css') }}">
<script src="{{ asset('js/bootstrap-multiselect.min.js') }}"></script>
@endsection

@section('content')
<!-- エラーや操作完了のメッセージ -->
<div class="card-header d-flex flex-column">
    <div class="d-flex justify-content-between">
        <div>
            プロジェクト管理
            <x-manage.display_index_count :props="$projects" />
        </div>
        <div class="text-right">
            <a href="{{ route($role.'.project.create') }}" class="btn btn-outline-success">新規作成</a>
        </div>
    </div>
    <form action="{{ route($role.'.project.index') }}" class="form-inline pr-3" method="get" style="position: relative"
        id='project_form'>
        <p>
            <a class="btn btn-secondary mt-3 mr-2" data-toggle="collapse" href="#collapseExample" role="button"
                aria-expanded="false" aria-controls="collapseExample">
                詳細条件 ▼
            </a>
        </p>
        <div class="collapse" id="collapseExample" style="position: absolute; top: 55px; left: -10px; z-index: 1;">
            <div class="card">
                <div class="card-header">プロジェクトID</div>
                <div class="card-body">
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">PR</span>
                        </div>
                        <input type="number" class="form-control" value="{{ Request::get('project') }}"
                            name="project">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">掲載状態</div>
                <div class="card-body">
                    <div class="d-flex mb-2 flex-column align-items-start">
                        @foreach(ProjectReleaseStatus::getValues() as $release_status)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $release_status }}"
                                name="release_statuses[]" id="flexCheckDefault"
                                {{ Request::get('release_statuses') !== null && in_array($release_status, Request::get('release_statuses')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ $release_status }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <select class="form-control" name="release_period">
                        <option value="">掲載期間</option>
                        @foreach(App\Enums\ProjectReleasePeriod::getValues() as $release_period)
                            <option value="{{ $release_period }}" {{ $release_period === Request::get('release_period') ? 'selected' : '' }}>
                                {{ $release_period }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <x-manage.sort_form :props_array="[
            'id' => 'ID',
            'title' => 'タイトル',
            'user_name' => 'ユーザー名',
            'liked_users_count' => 'いいね数',
        ]" />
        <input name="word" type="search" class="form-control mr-2" aria-lavel="Search" placeholder="キーワードで検索"
            value="{{ Request::get('word') }}">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
    </form>
</div>
<x-manage.search-terms :role="$role" model='project' />

<div class="card-body">
    <form id='operate_projects' action="{{ route('admin.project.operate_projects') }}" method="POST">
        @csrf
        <select name='change_status' class="form-control-inline" form='operate_projects'>
            <option value="" style="display: none;">選択項目の掲載状態を変更</option>
            @foreach (ProjectReleaseStatus::getValues() as $release_status)
            <option value={{ $release_status }}>
                {{ $release_status }}
            </option>
            @endforeach
        </select>
        <input class="btn btn-primary my-2 my-sm-0" id="operate_projects_button" form='operate_projects' type="submit" value="実行"></input>
    </form>
</div>
@if($projects->count() <= 0) <p>表示する投稿はありません。</p>
    @else
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th scope="col" width="10%" class="text-nowrap">
                        <input name='checkbox' type="checkbox" id='checkbox_parent' {{ old('checkbox')?'checked':'' }}>
                        選択
                    </th>
                    <th scope="col" width="10%" class="text-nowrap">掲載状態</th>
                    <th scope="col" width="10%" class="text-nowrap">掲載日時</th>
                    <th scope="col" width="10%" class="text-nowrap">ID</th>
                    <th scope="col" width="10%" class="text-nowrap">タイトル</th>
                    <th scope="col" width="10%" class="text-nowrap">インフルエンサー</th>
                    <th scope="col" width="10%" class="text-nowrap">目標金額</th>
                    <th scope="col" width="10%" class="text-nowrap">達成金額</th>
                    <th scope="col" width="10%" class="text-nowrap">手数料</th>
                    <th scope="col" width="10%" class="text-nowrap">オプション料金</th>
                    <th scope="col" width="10%" class="text-nowrap">合計支払い金額</th>
                    <th scope="col" width="10%" class="text-nowrap">キュレーター</th>
                    <th scope="col" width="10%" class="text-nowrap">詳細</th>
                    <th scope="col" width="10%" class="text-nowrap">関連一覧画面</th>
                    <th scope="col" width="10%" class="text-nowrap">編集/削除</th>
                    @if($role === "admin")
                    <th scope="col" width="10%" class="text-nowrap">いいね数</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td>
                        <input form="operate_projects" class="checkbox" type="checkbox" name="project_id[]" id="project_id[]"
                            value={{ $project->id }}>
                    </td>
                    <td class="text-nowrap">
                        @if ($project->release_status === "---")
                        <div class="card border-primary text-center">
                            <div class="card-header bg-transparent border-primary">---</div>
                        </div>
                        @elseif ($project->release_status === "差し戻し")
                        <div class="card border-warning text-center">
                            <div class="card-header bg-transparent border-warning">差し戻し</div>
                        </div>
                        @elseif ($project->release_status === "承認待ち")
                        <div class="card border-info text-center">
                            <div class="card-header bg-transparent border-info">承認待ち</div>
                        </div>
                        @elseif ($project->release_status === "掲載中")
                        <div class="card border-success text-center">
                            <div class="card-header bg-transparent border-success">掲載中</div>
                        </div>
                        @elseif ($project->release_status === "掲載停止中")
                        <div class="card border-secondary text-center">
                            <div class="card-header bg-transparent border-secondary">掲載停止中</div>
                        </div>
                        @endif
                    </td>
                    <td class="text-nowrap">
                        開始日: {{ $project->start_date }}
                        <br/>
                        終了日: {{ $project->end_date }}
                        <div class="d-flex justify-content-around">
                        @if(DateFormat::checkDateIsPast($project->end_date))
                            <form action="{{ route('admin.project.remittance', ['project' => $project]) }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-danger" type="submit" onclick="return confirm('本当に送金してもよろしいでしょうか。')">
                                    送金実行
                                </button>
                            </form>
                        @endif
                        @if($project->deposits_exists)
                        <a class="mt-1" data-toggle="modal" data-target="#deposit_index{{ $project->id }}">
                            送金履歴
                        </a>
                        <div class="modal fade" id="deposit_index{{ $project->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="user_content_modal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="user_content_modal">
                                            送金履歴
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <a href="https://test-remittance.gmopg.jp/admin/depositSearch" target="_blank">GMOのダッシュボードで確認</a>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col" width="10%" class="text-nowrap">送金ID</th>
                                                        <th scope="col" width="10%" class="text-nowrap">送金金額</th>
                                                        <th scope="col" width="10%" class="text-nowrap">送金状況</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($project->deposits as $deposit)
                                                    <tr>
                                                        <td>{{ $deposit->deposit_id }}</td>
                                                        <td class="text-right">{{ number_format($deposit->gmo_deposit_amount) }}円</td>
                                                        <td>{{ config('depositresult')[$deposit->gmo_deposit_result] }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        </div>
                    </td>
                    <td>
                        {{ $project->display_id }}
                    </td>
                    <td class="text-nowrap">
                        {{ Str::limit($project->title, 30) }}
                    </td>
                    <td>
                        <a class="mt-1" data-toggle="modal" data-target="#user_index{{ $project->id }}">
                            {{ $project->user->name }}
                        </a>
                        <div class="modal fade" id="user_index{{ $project->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="user_content_modal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="user_content_modal">
                                            {{ $project->user->name }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>電話番号:
                                            <a href="tel:{{ optional($project->user->profile)->phone_number }}">
                                                {{ optional($project->user->profile)->phone_number }}
                                            </a>
                                        </p>
                                        <p>Email:<a href="mailto:{{ $project->user->email }}">{{ $project->user->email }}</a></p>
                                        <p>StripeのアカウントID: {{ optional($project->user->identification)->connected_account_id }}</p>
                                        <p>プロフィール画像:
                                            <div class="text-center">
                                                <img style="max-height:15vw; object-fit: contain;"
                                                    src="{{ Storage::url(optional($project->user->profile)->image_url) }}">
                                            </div>
                                        </p>
                                        <p>SNS:
                                            <div class="d-flex justify-content-around">
                                                @if (optional($project->user->snsLink)->twitter_url)
                                                <a href="{{ optional($project->user->snsLink)->twitter_url }}"><img src="{{ asset('image/twitter.png') }}" alt="" height="48px" width="48px"></a>
                                                @endif
                                                @if (optional($project->user->snsLink)->instagram_url)
                                                <a href="{{ optional($project->user->snsLink)->instagram_url }}"><img src="{{ asset('image/instagram.png') }}" alt="" height="48px" width="48px"></a>
                                                @endif
                                                @if (optional($project->user->snsLink)->youtube_url)
                                                <a href="{{ optional($project->user->snsLink)->youtube_url }}"><img src="{{ asset('image/youtube.png') }}" alt="" height="48px" width="48px"></a>
                                                @endif
                                                @if (optional($project->user->snsLink)->tiktok_url)
                                                <a href="{{ optional($project->user->snsLink)->tiktok_url }}"><img src="{{ asset('image/tiktok.png') }}" alt="" height="48px" width="48px"></a>
                                                @endif
                                                @if (optional($project->user->snsLink)->other_url)
                                                <a href="{{ optional($project->user->snsLink)->other_url }}"><img src="{{ asset('image/other_sns.png') }}" alt="" height="48px" width="48px"></a>
                                                @endif
                                            </div>
                                        </p>
                                        <p>姓:{{ optional($project->user->profile)->last_name }}</p>
                                        <p>名:{{ optional($project->user->profile)->first_name }}</p>
                                        <p>姓(カナ):{{ optional($project->user->profile)->last_name_kana }}</p>
                                        <p>名(カナ):{{ optional($project->user->profile)->first_name_kana }}</p>
                                        <p>生年月日:{{ optional($project->user->profile)->birthday }}</p>
                                        <p>公開状態:{{ optional($project->user->profile)->birthday_is_published ?'公開中':'非公開中' }}</p>
                                        <p>性別:{{ optional($project->user->profile)->gender }}</p>
                                        <p>公開状態:{{ optional($project->user->profile)->gender_is_published ?'公開中':'非公開中' }}</p>
                                        <p>紹介文:{{ optional($project->user->profile)->introduction }}</p>
                                        <p></p>
                                        <p>郵便番号:{{ optional($project->user->address)->postal_code }}</p>
                                        <p>都道府県:{{ optional($project->user->address)->prefecture }}</p>
                                        <p>住所1(市町村など):{{ optional($project->user->address)->city }}</p>
                                        <p>住所2(丁目など):{{ optional($project->user->address)->block }}</p>
                                        <p>住所3(番地など):{{ optional($project->user->address)->block_number }}</p>
                                        <p>住所4(建物番号など):{{ optional($project->user->address)->building }}</p>
                                        <div class="card-header">本人確認項目</div>
                                        <p>金融機関コード:{{ optional($project->user->identification)->bank_code }}</p>
                                        <p>支店コード:{{ optional($project->user->identification)->branch_code }}</p>
                                        <p>口座種別:{{ optional($project->user->identification)->account_type }}</p>
                                        <p>口座番号:{{ optional($project->user->identification)->account_number }}</p>
                                        <p>口座名義人名:{{ optional($project->user->identification)->account_name }}</p>
                                        <p>本人確認書類１:</p>
                                        <span class="text-danger">※クリックすると画像をダウンロードできます。</span>
                                        <div class="text-center">
                                            <a class="text-center" href="{{ route('admin.user.download_identify_image', ['user' => $project->user, 'column_name' => 'identify_image_1']) }}">
                                                <img style="max-height:15vw; object-fit: contain;"
                                                    src="{{ Storage::url(optional($project->user->identification)->identify_image_1) }}">
                                            </a>
                                        </div>
                                        <p>本人確認書類２:</p>
                                        <span class="text-danger">※クリックすると画像をダウンロードできます。</span>
                                        <div class="text-center">
                                            <a href="{{ route('admin.user.download_identify_image', ['user' => $project->user, 'column_name' => 'identify_image_2']) }}">
                                                <img style="max-height:15vw; object-fit: contain;"
                                                    src="{{ Storage::url(optional($project->user->identification)->identify_image_2) }}">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="text-nowrap">
                        {{ number_format($project->target_number) }}円
                    </td>
                    <td class="text-nowrap">
                        {{ number_format($project->payments_sum_price) }}円
                    </td>
                    <td class="text-nowrap">
                        {{ number_format($project->aplication_fee) }}円
                    </td>
                    <td class="text-nowrap">
                        <form action="{{ route('admin.project.associate_option_fee', ['project' => $project]) }}" method="POST" style="width: 200px;">
                            @method('PUT')
                            @csrf
                            <div class="form-row">
                                <div class="input-group col-sm-8">
                                    <input type="number" class="form-control" name="option_fee" value="{{ $project->option_fee }}"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">円</span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary col-sm-4">更新</button>
                            </div>
                        </form>
                    </td>
                    <td class="text-nowrap">
                        {{ number_format($project->remittance_amount) }}円
                    </td>
                    <td class="text-nowrap">
                        <form action="{{ route('admin.project.associate_curator', ['project' => $project]) }}" method="POST" class="form-inline" style="width: 180px;">
                            @method('PUT')
                            @csrf
                            <select name="curator_id" class="form-control col-sm-8">
                                <option value="">未定</option>
                                @foreach ($curators() as $curator)
                                    <option value="{{ $curator->id }}" {{ old('curator_id', optional($project->curator)->id) === $curator->id ? 'selected' : '' }}>{{ $curator->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary col-sm-4">更新</button>
                        </form>
                    </td>
                    <td class="text-nowrap">
                        <button class="btn btn-secondary" type="button" data-toggle="collapse"
                            data-target="#collapse_detail{{ $project->id }}" aria-expanded="false"
                            aria-controls="#collapse_detail{{ $project->id }}">
                            詳細 ▼
                        </button>

                        <div class="collapse {{ $loop->index === 0?'show':'' }}" id="collapse_detail{{$project->id}}">
                            <div class="card bg-transparent" style="border: none;">
                                <a href="{{ route($role.'.project.show', ['project' => $project]) }}"
                                    class="btn btn-sm btn-primary mt-1">確認</a>
                                <a href="{{ route('user.project_preview', ['project' => $project] )}}"
                                    class="btn btn-sm btn-success mt-1" target="_blank">プレビュー表示</a>
                            </div>
                        </div>
                    </td>
                    <td class="text-nowrap">
                        <button class="btn btn-secondary" type="button" data-toggle="collapse"
                            data-target="#collapse{{ $project->id }}" aria-expanded="false"
                            aria-controls="#collapse{{ $project->id }}">
                            一覧 ▼
                        </button>

                        <div class="collapse {{ $loop->index === 0?'show':'' }}" id="collapse{{$project->id}}">
                            <div class="card bg-transparent" style="border: none;">
                                <a href="{{ route($role.'.plan.index', ['project' => $project]) }}"
                                    class="btn btn-sm btn-primary mt-1">リターン一覧</a>
                                <a href="{{ route($role.'.payment.index', ['project' => $project] )}}" style="font-size: 0.5vw"
                                    class="btn btn-sm btn-primary mt-1">支援者(ファン)一覧</a>
                                <a href="{{ route($role.'.report.index', ['project' => $project] )}}"
                                    class="btn btn-sm btn-primary mt-1">活動報告一覧</a>
                                <a href="{{ route($role.'.comment.index', ['project' => $project] )}}"
                                    class="btn btn-sm btn-primary mt-1">コメント一覧</a>
                            </div>
                        </div>
                    </td>

                    <td class="text-nowrap">
                        <button class="btn btn-secondary" type="button" data-toggle="collapse"
                            data-target="#collapseExample{{ $project->id }}" aria-expanded="true"
                            aria-controls="collapseExample">
                            設定 ▼
                        </button>
                        <div class="collapse {{ $loop->index === 0?'show':null }}" id="collapseExample{{$project->id}}">
                            <div class="card bg-transparent" style="border: none;">
                                @if ($project->release_status !== ' 掲載中'&&$project->
                                release_status!=='承認待ち'||$role==="admin")
                                <a href="{{ route($role.'.project.edit', ['project' => $project]) }}"
                                    class="btn btn-sm btn-primary mt-1">編集</a>
                                <form action="{{ route($role.'.project.destroy', ['project' => $project]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger mt-1 w-100 btn-dell" onclick="return confirm('本当に削除しますか？')" type="submit">削除</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </td>
                    </form>
                    <td>
                        <div class="d-flex flex-column justify-content-center">
                            <div class="d-flex justify-content-center">
                                <p>
                                    <img style="height:1em" src="/image/heart.jpg">
                                </p>
                                <p id="total_likes_{{ $project->id }}">
                                    {{ $project->total_likes }}
                                </p>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $projects->appends(request()->input())->links() }}
    </div>
    @endif
    </div>
    @section('script')
    <script src="{{ asset('/js/check-checked.js') }}"></script>
    <script src="{{ asset('/js/all-checkbox-toggle.js') }}"></script>

    <script type="text/javascript">
        window.addEventListener('DOMContentLoaded', () => {
            checkChecked('#operate_projects_button',".checkbox");
            allCheckBoxToggle('#checkbox_parent',".checkbox");
        });
    </script>

    <script>
        function incrementLikes(projectId, incrementPoints){
        $.ajax({
            url: '/admin/project/' + projectId + '/increment_likes/',
            type: 'PATCH',
            data: {'project': projectId, 'add_point': incrementPoints},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        })
        .done(function(res) {
            document.getElementById('total_likes_' + projectId).innerText = res.total_likes;
        })
        .fail(function(res) {
            if (res.responseJSON.errors) {
                alert(
                    res.responseJSON.status
                    + "\n" +
                    res.responseJSON.errors.add_point
                );
            } else {
                alert("エラーが発生しました。");
            }
            location.reload();
        });
    }
    function decrementLikes(projectId, decrementPoints){
        $.ajax({
            url: '/admin/project/' + projectId + '/decrement_likes/',
            type: 'PATCH',
            data: {'project': projectId, 'sub_point': decrementPoints},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        })
        .done(function(res) {
            document.getElementById('total_likes_' + projectId).innerText = res.total_likes;
        })
        .fail(function(res) {
            if (res.responseJSON.errors) {
                alert(
                    res.responseJSON.status
                    + "\n" +
                    res.responseJSON.errors.sub_point
                );
            } else {
                alert("エラーが発生しました。");
            }
            location.reload();
        });
    }

    </script>
    @endsection
    @endsection
