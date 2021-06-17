@extends('admin.layouts.base')

@section('title', '承認待ち企業詳細')


@section('content')
    <div class="card-header d-flex align-items-center">
        <div class="flex-grow-1">承認待ち企業詳細</div>
        <div class="text-right">
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-3">
                    <img src="{{ asset(Storage::url($temporary_company->image_url)) }}" class="rounded-circle"
                         style="width: 80%">
                </div>
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-header"><h2>{{ $temporary_company->name }}</h2></div>
                        <div class="card-body">
                            <h3>Email: {{ $temporary_company->email }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-3">
                <form class="m-2"
                    action="{{ route('admin.temporary_company.accept', ['temporary_company' => $temporary_company]) }}"
                    method="post">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn-lg btn-success btn-accept">承認</button>
                </form>
                <form class="m-2"
                    action="{{ route('admin.temporary_company.reject', ['temporary_company' => $temporary_company]) }}"
                    method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-lg btn-danger btn-reject">拒否</button>
                </form>
            </div>
        </div>
    </div>

@section('script')
    <script>
        /*拒否確認用jquery*/
        $(function () {
            $(".btn-reject").click(function () {
                if (confirm("本当にこの承認待ち企業の申請を拒否しますか？")) {
                    //そのままsubmit（削除）
                } else {
                    //cancel
                    return false;
                }
            });
        });
    </script>
@endsection
@endsection
