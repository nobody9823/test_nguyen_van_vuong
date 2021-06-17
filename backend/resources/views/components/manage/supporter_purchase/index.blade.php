@extends($guard.'.layouts.base')

@section('title', '支援者・支援一覧')

@section('content')

<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">支援者・支援一覧</div>
    <form action="{{ route('admin.supporter_purchase.search') }}" class="form-inline pr-3" method="get">
        @csrf
        <div class="input-group">
            <input type="number" class="form-control" name="price" placeholder="支援額"
                value="{{ Request::get('price') }}">
            <span class="input-group-text">円</span>
            <input type="text" class="form-control" name="from_date" placeholder="支援日(から)"
                value="{{ Request::get('from_date') }}" id="from_date">
            <span class="input-group-text">から</span>
            <input type="text" class="form-control" name="to_date" placeholder="支援日(まで)"
                value="{{ Request::get('to_date') }}" id="to_date">
            <span class="input-group-text">まで</span>
        </div>
        <input name="word" type="search" class="form-control" aria-lavel="Search" placeholder="キーワードで検索"
            value="{{ Request::get('word') }}">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
    </form>
</div>
<div class="card-body">
    @if($supporterPurchases->count() <= 0) <p>表示する投稿はありません。</p>
        @else
        <table class="table">
            <tr>
                <th style="width:5%">支援者名</th>
                <th style="width:5%">支援日</th>
                <th style="width:5%">支援額</th>
                <th style="width:10%">オプション</th>
                <th style="width:10%">企業名/タレント名</th>
                <th style="width:20%">プロジェクト名/支援プラン</th>
                <th style="width:10%">メッセージ</th>
            </tr>
            @foreach($supporterPurchases as $supporter_purchase)
            <tr>
                <td>
                    {{ $supporter_purchase->user->name }}
                </td>
                <td>
                    {{ $supporter_purchase->created_at }}
                </td>
                <td>
                    {{ number_format($supporter_purchase->plan->price) }}円
                </td>
                <td>
                    {{ $supporter_purchase->selected_option }}
                </td>
                <td>
                    {{ $supporter_purchase->plan->project->talent->company->name }}
                    <br>
                    {{ $supporter_purchase->plan->project->talent->name }}
                </td>
                <td>
                    {{ $supporter_purchase->plan->project->title }}
                    <br>
                    {{ $supporter_purchase->plan->title }}
                </td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#messageModal{{ $loop->iteration }}">
                        メッセージ
                    </button>
                    @if ($supporter_purchase->message_status !== '対応済')
                    <small style="display: block;color:red">
                        {{ $supporter_purchase->message_status }}
                    </small>
                    @else
                    <small style="display: block">
                        {{ $supporter_purchase->message_status }}
                    </small>
                    @endif
                    {{-- <a class="btn btn-primary"
                        href="{{route('admin.message.show',['message' => $supporter_purchase])}}">メッセージ</a> --}}
                    {{-- メッセージモーダル --}}
                    <div class="modal fade" id="messageModal{{ $loop->iteration }}" tabindex="-1" role="dialog"
                        aria-labelledby="messageModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="messageModalLabel">メッセージ履歴</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{-- 選択によって変わるメッセージ部分 --}}
                                    <x-common.message.message_viewer :selectedMessage="$supporter_purchase"
                                        guard="admin" />
                                    {{-- 選択によって変わるメッセージ部分 --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- メッセージモーダル --}}
                </td>
            </tr>
            @endforeach
        </table>


        <div class="d-flex justify-content-center">
            {{ $supporterPurchases->appends(request()->input())->links() }}
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
<!-- datetimepicker -->
<script src="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/build/jquery.datetimepicker.full.min.js">
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/jquery.datetimepicker.css">
<script>
    $(function () {
        $('#from_date').datetimepicker({
            format: 'Y-m-d'
        });
    });
</script>
<script>
    $(function () {
        $('#to_date').datetimepicker({
            format: 'Y-m-d'
        });
    });
</script>
@endsection

@endsection
