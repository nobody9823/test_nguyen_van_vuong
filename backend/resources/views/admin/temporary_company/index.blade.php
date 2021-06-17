@extends('admin.layouts.base')

@section('title', '承認待ち企業管理')

@section('content')
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">
        @if($word ?? '')
            {{ $word }} の検索結果 (全{{ count($temporary_companies) }}件)
        @else
            承認待ち企業管理
        @endif
    </div>
    <form action="{{ route('admin.temporary_company.search') }}" class="form-inline pr-3" method="get">
        @csrf
        <input name="word" type="search" class="form-control" aria-level="Search" placeholder="キーワードで検索">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
    </form>
    <div class="text-right">
    </div>
</div>
<div class="card-body">
    @if(count($temporary_companies) <= 0) <p>承認待ち企業は存在しません。</p>
        @else
        <table class="table">
            <tr>
                <th>企業名</th>
                <th>メールアドレス</th>
                <th>詳細</th>
                <th>承認</th>
                <th>拒否</th>
            </tr>
            @foreach($temporary_companies as $temporary_company)
            <tr>
                <td>{{ $temporary_company->name }}</td>
                <td>{{ $temporary_company->email }}</td>
                <td><a href="/admin/temporary_company/{{ $temporary_company->id }}"
                        class="btn btn-primary btn-sm">詳細</a></td>
                <td>
                    <form action="{{ route('admin.temporary_company.accept', ['temporary_company' => $temporary_company]) }}" method="post">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-success btn-sm btn-accept">承認</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('admin.temporary_company.reject', ['temporary_company' => $temporary_company]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit"  class="btn btn-danger btn-sm btn-reject">拒否</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center text-center">
            {{ $temporary_companies->appends(request()->input())->links() }}
        </div>
        @endif
</div>
@section('script')
<script>
    /*拒否確認用jquery*/
    $(function(){
    $(".btn-reject").click(function(){
    if(confirm("本当にこの承認待ち企業の申請を拒否しますか？")){
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
