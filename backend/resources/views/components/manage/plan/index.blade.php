@extends($role.'.layouts.base')

@section('title', 'リターン一覧')

@section('content')
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">
        リターン一覧
        <x-manage.display_index_count :props="$plans" />
    </div>
    <form action="{{ route($role.'.plan.index') }}" class="form-inline pr-3" method="get" style="position: relative">
        @csrf
        <x-common.add_hidden_query />
        <p>
            <a class="btn btn-secondary mt-3 mr-3" data-toggle="collapse" href="#collapseExample" role="button"
                aria-expanded="false" aria-controls="collapseExample">
                詳細条件 ▼
            </a>
        </p>
        <div class="collapse" id="collapseExample" style="position: absolute; top: 55px; left: -10px;">
            <div class="card card-body">
                <div class="form-group mb-2 flex-column">
                    <div class="form-check flex-column">
                        <label>
                            価格
                        </label>
                        <div class="form-group">
                            <input type="number" class="form-control" value="{{ Request::get('min_price') }}"
                                name="min_price">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">円</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" value="{{ Request::get('max_price') }}"
                                name="max_price">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">円</span>
                            </div>
                        </div>
                        <label>
                            リターン提供日
                        </label>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ Request::get('from_date') }}"
                                name="from_date" id="from_date">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">日から</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ Request::get('to_date') }}" name="to_date"
                                id="to_date">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">日まで</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-manage.sort_form :props_array="[
            'title' => 'タイトル',
            'price' => '価格',
            'delivery_date' => 'リターン提供日',
        ]" />
        <input name="word" type="search" class="form-control" aria-lavel="Search" placeholder="キーワードで検索"
            value="{{ Request::get('word') }}">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
    </form>
    @if ($project !== null && (($project->release_status !== '掲載中' && $project->release_status !== '承認待ち') || $role ===
    "admin"))
    <a href="{{ route($role.'.plan.create', ['project' => $project]) }}" class="btn btn-success">新規作成</a>
    @endif
</div>
<x-manage.search-terms role="admin" model='plan' />
<div class="card-body">
    @if($plans->count() <= 0) <p>表示する投稿はありません。</p>
        @else
        <table class="table">
            <tr>
                <th style="width:10%">リターン名</th>
                <th style="width:25%">リターン内容</th>
                <th style="width:8%">価格</th>
                <th style="width:10%">リターン提供日</th>
                <!-- <th style="width:10%">プレビュー</th> -->
                @if($project !== null && (($project->release_status !== '掲載中' && $project->release_status !== '承認待ち') ||
                $role === "admin"))
                <th style="width:10%">編集</th>
                <th style="width:10%">削除</th>
                @else
                <th style="width: 10%">リターン詳細</th>
                @endif
            </tr>
            @foreach($plans as $plan)
            <tr>
                <td>
                    {{ $plan->title }}
                </td>
                <td>
                    <p class="plan-content">{{ Str::limit($plan->content, 200) }}</p>
                </td>
                <td>
                    {{ number_format($plan->price) }}円
                </td>
                <td>
                    {{ $plan->formatted_delivery_date }}
                </td>
                <!-- <td>
                    <a href="{{ route($role.'.plan.preview', ['project' => $plan->project->id, 'plan' => $plan]) }}"
                        class="btn btn-success">
                        表示
                    </a>
                </td> -->
                @if($project !== null && (($project->release_status !== '掲載中' && $project->release_status !== '承認待ち') ||
                $role === "admin"))
                <td>
                    <a class="btn btn-primary"
                        href="{{ route($role.'.plan.edit', ['project' => $plan->project, 'plan' => $plan]) }}">編集</a>
                </td>
                <form action="{{ route($role.'.plan.destroy', ['project' => $project, 'plan' =>$plan]) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <td>
                        <button class="btn btn-danger btn-dell" type="submit">削除</button>
                    </td>
                </form>
                @else
                <td>
                    <a class="btn btn-primary" href="{{ route($role.'.plan.show', ['plan' => $plan]) }}">詳細</a>
                </td>
                @endif
            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
            {{ $plans->appends(request()->input())->links() }}
        </div>
        @endif
</div>
@section('script')
<script>
    $(function() {
        $(".btn-dell").click(function() {
            if (confirm("本当に削除しますか？")) {
                //そのままsubmit（削除）
            } else {
                //cancel
                return false;
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/build/jquery.datetimepicker.full.min.js">
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/jquery.datetimepicker.css">
<script>
    $(function () {
        $('#from_date').datetimepicker({
            format: 'Y-m-d'
        });
        $('#to_date').datetimepicker({
            format: 'Y-m-d'
        });
    });
</script>
@endsection
@endsection
