@extends('admin.layouts.base')

@section('title', 'ユーザー管理')

@section('content')
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">
        ユーザー管理
        <x-manage.display_index_count :props="$users" />
    </div>
    <form action="{{ route('admin.user.index') }}" class="form-inline pr-3" method="get">
        <x-manage.sort_form :props_array="[
            'name' => '名前',
            'email' => 'email',
        ]" />
        <input name="word" type="search" class="form-control" aria-lavel="Search" placeholder="キーワードで検索"
            value="{{ Request::get('word') }}">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
    </form>
    <div class="text-right">
        <a href="{{ route('admin.user.create') }}" class="btn btn-outline-success">新規作成</a>
    </div>
</div>
<x-manage.search_terms role="admin" model='user' />
<div class="card-body">
    @if(count($users) <= 0) <p>ユーザーデータがありません。</p>
        @else
        <table class="table">
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><a class="btn btn-primary" href="{{route('admin.user.edit',['user' => $user])}}">編集</a>
                </td>
                <td>
                    <form action="{{route('admin.user.destroy',['user' => $user])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-dell">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center text-cneter">
            {{ $users->appends(request()->input())->links() }}
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
@endsection

@endsection
