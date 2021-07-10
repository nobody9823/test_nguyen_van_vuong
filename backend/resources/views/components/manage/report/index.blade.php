@extends($role.'.layouts.base')

@section('title', '活動報告一覧')

@section('content')
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">
        活動報告一覧
        <x-manage.display_index_count :props="$reports" />
    </div>
    <form action="{{ route($role.'.report.index') }}" class="form-inline pr-3" method="get">
        <x-common.add_hidden_query />
        <x-manage.sort_form :props_array="[
            'title' => 'タイトル',
            'content' => '内容',
        ]" />
        <input name="word" type="search" class="form-control" aria-level="Search" placeholder="キーワードで検索"
            value="{{ Request::get('word') }}">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
    </form>
    @if ($project !== null)
    <div class="text-right">
        <a href="{{ route($role.'.report.create', ['project' => $project]) }}"
            class="btn btn-outline-success mb-2">新規作成</a>
    </div>
    @endif
</div>
<x-manage.search-terms role="admin" model='report' />

<div class="card-body">
    @if($reports->count() <= 0) <p>表示する投稿はありません。</p>
        @else
        <table class="table activity_report_list">
            <tr>
                <th style="width:20%">タイトル</th>
                <th style="width:60%">内容</th>
                @if($project !== null)
                <th style="width:10%">編集</th>
                <th style="width:10%">削除</th>
                @else
                <th style="width:10%">詳細</th>
                @endif
            </tr>
            @foreach($reports as $report)
            <tr class="activity_report">
                <td>
                    {{ $report->title }}
                </td>
                <td>
                    {{ $report->content }}
                </td>
                @if($project !== null)
                <td>
                    <a href="{{ route($role.'.report.edit', ['project' => $project, 'report' => $report]) }}"
                        class="btn btn-primary">編集</a>
                </td>
                <form action="{{ route($role.'.report.destroy', ['project' => $project, 'report' => $report]) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <td>
                        <button class="btn btn-danger btn-dell" type="submit" name="report_linked_project"
                            value="report_linked_project">削除</button>
                    </td>
                </form>
                @else
                <td>
                    <a href="{{ route($role.'.report.show', ['report' => $report]) }}" class="btn btn-primary">表示</a>
                </td>
                @endif
            </tr>
            @endforeach
        </table>
        @endif

        {{ $reports->appends(request()->input())->links() }}
</div>
@section('script')
<script>
    $(function(){
        $(".btn-dell").click(function(){
                //そのままsubmit（削除）
                if(confirm("本当に削除しますか？")){
            }else{
                //cancel
                return false;
            }
        });
    });
</script>
@endsection
@endsection
