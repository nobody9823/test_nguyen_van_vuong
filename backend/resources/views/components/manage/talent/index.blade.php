@extends($role.'.layouts.base')

@section('title', 'タレント管理')

<!-- 公開非公開ボタン -->
@section('css')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script src="{{ asset('js/bootstrap-multiselect.min.js') }}"></script>
@endsection

@section('content')
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">承認済みタレント管理</div>
    <form action="{{ route($role.'.talent.search') }}" class="form-inline pr-3" method="get">
        @csrf
        <input name="word" type="search" class="form-control" aria-level="Search" placeholder="キーワードで検索">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
    </form>
    <div class="text-right">
        <a href="{{ route($role.'.talent.create') }}" class="btn btn-outline-success">新規作成</a>
    </div>
</div>
@if(Request::get('word'))
    <div class="card-header d-flex align-items-center">
        <div class="flex-grow-1">検索キーワード : {{ Request::get('word') }}</div>
    </div>
@endif
<div class="card-body">
    @if(count($talents) <= 0) <p>会社データがありません。</p>
        @else
        <table class="table">
            <tr>
                <th>タレント名/</br>メールアドレス</th>
                <th>採用状況</th>
                <th>雇用形態</th>
                <th>待遇</th>
                <th>時給</th>
                <th>退職状況</th>
                <th>シフト/</br>実績</th>
                <th>操作</th>
                <th>公開状態</th>
            </tr>
            @foreach($talents as $talent)
            <tr>
                <td>{{ $talent->name }}</br>{{ $talent->email }}</td>
                <td>{{ $talent->recruitment_status }}</td>
                <td>{{ $talent->employment_status }}</td>
                <td>{{ $talent->evaluation_status }}</td>
                <td>{{ $talent->hourly_wage }}円</td>
                <td>{{ $talent->resignation_status }}</td>
                <td>
                    <a class="btn btn-primary mb-2" href="{{route($role.'.work_shift.edit',['talent' => $talent])}}">シフト一覧</a>
                </br>
                    <a class="btn btn-primary" href="{{route($role.'.work_attendance.edit',['talent' => $talent])}}">実績一覧</a>
                </td>
                <td>
                    <a href="{{ route($role.'.talent.edit', ['talent' => $talent]) }}" class="btn btn-primary mb-2">編集</a>
                </br>
                    <form action="{{ route($role.'.talent.destroy', ['talent' => $talent]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-dell">削除</button>
                    </form>
                </td>
                <td>
                    <a class="btn-release" id="{{ $talent->id }}">
                        @if ($talent->is_released === 0)
                        <input type="checkbox" data-toggle="toggle" data-on="公開済み" data-off="非公開">
                        <div class="console-event"></div>
                        @else
                        <input type="checkbox" data-toggle="toggle" data-on="公開済み" data-off="非公開" checked>
                        <div class="console-event"></div>
                        @endif
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center text-cneter">
            {{ $talents->appends(request()->input())->links() }}
        </div>
        @endif
</div>
@section('script')
<script>
    $(function(){
    $(".btn-dell").click(function(){
    if(confirm("本当に削除しますか？")){
    //そのままsubmit（削除）
    }else{
    //cancel
    return false;
    }
    });
    });
</script>
<script src="{{ asset('js/talent-release-button.js') }}"></script>
<script>
$(function(){
    $('.btn-release').on('click', function(){
        var El = $(this);
        releaseButton(El);
    })
})
</script>
@endsection
@endsection
