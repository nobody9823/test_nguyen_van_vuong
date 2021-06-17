@extends('admin.layouts.base')

@section('title', '承認待ちタレント詳細')


@section('content')
    <div class="card-header d-flex align-items-center">
        <div class="flex-grow-1">承認待ちタレント詳細</div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-3">
                    <img src="{{ asset(Storage::url($temporary_talent->image_url)) }}" class="rounded-circle"
                         style="width: 80%">
                </div>
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-header"><h2>{{ $temporary_talent->name }}</h2></div>
                        <div class="card-body">
                            <h3>Email: {{ $temporary_talent->email }}</h3>
                            <h3>所属企業: {{ $temporary_talent->company->name }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-3">
                <form class="m-2"
                    action="{{ route('admin.temporary_talent.accept', ['temporary_talent' => $temporary_talent]) }}"
                    method="post">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn-lg btn-success btn-accept">承認</button>
                </form>
                <form class="m-2"
                    action="{{ route('admin.temporary_talent.reject', ['temporary_talent' => $temporary_talent]) }}"
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
                if (confirm("本当にこの承認待ちタレントの申請を拒否しますか？")) {
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
