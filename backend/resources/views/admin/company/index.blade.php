@extends('admin.layouts.base')

@section('title', '会社管理')

<!-- 公開非公開ボタン -->
@section('css')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.min.css') }}">
<script src="{{ asset('js/bootstrap-multiselect.min.js') }}"></script>
@endsection

@section('content')
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">
        @if($word ?? '')
            {{ $word }} の検索結果 (全{{ count($companies) }}件)
        @else
            承認済み会社管理
        @endif
        </div>
    <form action="{{ route('admin.company.search') }}" class="form-inline pr-3" method="get">
        @csrf
        <input name="word" type="search" class="form-control" aria-level="Search" placeholder="キーワードで検索">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
    </form>
    <div class="text-right">
        <a href="{{ route('admin.company.create') }}" class="btn btn-outline-success">新規作成</a>
    </div>
</div>
<div class="card-body">
    @if(count($companies) <= 0) <p>会社データがありません。</p>
        @else
        <table class="table">
            <tr>
                <th>社名</th>
                <th>メールアドレス</th>
                <th>契約</th>
                <th>契約日</th>
                <th>契約終了日</th>
                <th>編集</th>
                <th>削除</th>
                <th>公開状態</th>
                <th>企業メモ</th>
            </tr>
            @foreach($companies as $company)
            <tr>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td>{{ $company->contract_status }}</td>
                <td>{{ $company->contract_date }}</td>
                <td>{{ $company->cancellation_date }}</td>
                <td><a class="btn btn-primary"
                        href="{{route('admin.company.edit',['company' => $company])}}">編集</a>
                <td>
                    <form action="{{route('admin.company.destroy',['company' => $company])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-dell">削除</button>
                    </form>
                </td>
                <td>
                    <a class="btn-release" id="{{ $company->id }}">
                        @if ($company->is_released === 0)
                        <input type="checkbox" data-toggle="toggle" data-on="公開済み" data-off="非公開">
                        <div class="console-event"></div>
                        @else
                        <input type="checkbox" data-toggle="toggle" data-on="公開済み" data-off="非公開" checked>
                        <div class="console-event"></div>
                        @endif
                    </a>
                </td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#remarks_{{ $company->id }}">
                        表示
                    </button>
                    <div class="modal fade" id="remarks_{{ $company->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ $company->name }}様の企業メモ</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.remarks.update', ['company' => $company]) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <textarea name="remarks" class="form-control" rows="10">{{ old('remarks', optional($company)->remarks) }}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                        <button class="btn btn-primary">保存</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center text-cneter">
            {{ $companies->appends(request()->input())->links() }}
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
<script src="{{ asset('js/company-release-button.js') }}"></script>
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
