@extends('company.layouts.base')

@section('title', '承認待ちタレント管理')

@section('content')
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">承認待ちタレント管理</div>
    <form action="{{ route('company.temporary_talent.search') }}" class="form-inline pr-3" method="POST">
        @csrf
        <input name="word" type="search" class="form-control" aria-level="Search" placeholder="キーワードで検索">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
    </form>
</div>
<div class="card-body">
    @if(count($temporary_talents) <= 0) <p>承認待ちタレントは存在しません。</p>
        @else
        <table class="table">
            <tr>
                <th>タレント名</th>
                <th>メールアドレス</th>
                <th>詳細</th>
                <th>承認</th>
                <th>拒否</th>
            </tr>
            @foreach($temporary_talents as $temporary_talent)
            <tr>
                <td>{{ $temporary_talent->name }}</td>
                <td>{{ $temporary_talent->email }}</td>
                <td><a href="/company/temporary_talent/{{ $temporary_talent->id }}"
                        class="btn btn-primary btn-sm">詳細</a></td>
                <td>
                    <form action="{{ route('company.temporary_talent.accept', ['temporary_talent' => $temporary_talent]) }}" method="post">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-success btn-sm btn-accept">承認</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('company.temporary_talent.reject', ['temporary_talent' => $temporary_talent]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit"  class="btn btn-danger btn-sm btn-reject">拒否</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center text-center">
            {{ $temporary_talents->links() }}
        </div>
        @endif
</div>
@section('script')
<script>
    /*拒否確認用jquery*/
    $(function(){
    $(".btn-reject").click(function(){
    if(confirm("本当にこの承認待ちタレントの申請を拒否しますか？")){
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
