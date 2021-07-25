@extends($guard.'.layouts.base')

@section('title', '支援者(ファン)管理')

@section('content')

<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">
        支援者(ファン)管理
        <x-manage.display_index_count :props="$payments" />
    </div>
    <form action="{{ route('admin.payment.index') }}" class="form-inline pr-3" method="get" style="position: relative">
        <p>
            <a class="btn btn-secondary mt-3 mr-3" data-toggle="collapse" href="#collapseExample" role="button"
                aria-expanded="false" aria-controls="collapseExample">
                詳細条件 ▼
            </a>
        </p>
        <div class="collapse" id="collapseExample" style="position: absolute; top: 55px; left: -100px;">
            <div class="card card-body">
                <div class="form-group mb-2 flex-column">
                    <div class="form-check flex-column">
                        <div class="form-group">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">支援ID</span>
                            </div>
                            <input type="text" class="form-control" value="{{ Request::get('payment_token') }}"
                                name="payment_token" id="payment_token">
                        </div>
                    </div>
                    <div class="form-check flex-column">
                        <label>
                            支援日
                        </label>
                        <div class="form-group">
                            <input type="text" class="form-control date_picker" value="{{ Request::get('from_date') }}"
                                name="from_date" id="from_date">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">日から</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control date_picker" value="{{ Request::get('to_date') }}"
                                name="to_date" id="to_date">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">日まで</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-check flex-column">
                        <label>
                            金額
                        </label>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ Request::get('from_price') }}"
                                name="from_price" id="from_price">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">円から</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ Request::get('to_price') }}"
                                name="to_price" id="to_price">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">円まで</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-manage.sort_form :props_array="[
            'created_at' => '支援時刻',
            'user_name' => '支援者名',
            'inviter_name' => '招待者名',
            'price' => '支援額',
            {{-- 'plan_payment_included_plan_project_user_name' => 'インフルエンサー名',
            'plan_payment_included_plan_project_title' => 'プロジェクト名', --}}
        ]" />
        <input name="word" type="search" class="form-control" aria-lavel="Search" placeholder="キーワードで検索"
            value="{{ Request::get('word') }}">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
    </form>
</div>
<x-manage.search-terms role='admin' model='payment' />
<div class="card-body">
    @if($payments->count() <= 0) <p>表示する投稿はありません。</p>
        @else
        @if(Request::get('project'))
        <form action="{{ route('admin.project.output_purchases_list_to_csv', ['project' => Request::get('project')]) }}">
            @csrf
            <button class="btn btn-secondary">CSV</button>
        </form>
        @endif
        <table class="table">
            <tr>
                <th style="width:15%">支援ID</th>
                <th style="width:5%">支援時刻</th>
                <th style="width:5%">支援者名</th>
                <th style="width:5%">招待者名</th>
                <th style="width:5%">支援額</th>
                <th style="width:10%">インフルエンサー名</th>
                <th style="width:10%">プロジェクト名</th>
                <th style="width:10%">支援プラン一覧</th>
                <th style="width:10%">メッセージ</th>
            </tr>
            @foreach($payments as $payment)
            <tr>
                <td>
                    {{ $payment->paymentToken->token }}
                </td>
                <td>
                    {{ $payment->created_at }}
                </td>
                <td>
                    <a class="mt-1" data-toggle="modal"
                                data-target="#user_index{{ $payment->id }}">
                        {{ $payment->user->name }}
                    </a>
                    <div class="modal fade" id="user_index{{ $payment->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="user_content_modal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="user_content_modal">
                                        {{ $payment->user->name }}
                                        {{ $payment->user->email }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>姓:{{ optional($payment->user->profile)->last_name }}</p>
                                    <p>名:{{ optional($payment->user->profile)->first_name }}</p>
                                    <p>姓(カナ):{{ optional($payment->user->profile)->last_name_kana }}</p>
                                    <p>名(カナ):{{ optional($payment->user->profile)->first_name_kana }}</p>
                                    <p>生年月日:{{ optional($payment->user->profile)->birthday }}</p>
                                    <p>公開状態:{{ optional($payment->user->profile)->birthday_is_published ?'公開中':'非公開中' }}</p>
                                    <p>性別:{{ optional($payment->user->profile)->gender }}</p>
                                    <p>公開状態:{{ optional($payment->user->profile)->gender_is_published ?'公開中':'非公開中' }}</p>
                                    <p>紹介文:{{ optional($payment->user->profile)->introduction }}</p>
                                    <p>画像:
                                        <img style="max-height:5vw;"
                                            src="{{ Storage::url(optional($payment->user->profile)->image_url) }}">
                                    </p>
                                    <p></p>
                                    <p>郵便番号:{{ optional($payment->user->address)->postal_code }}</p>
                                    <p>都道府県:{{ optional($payment->user->address)->prefecture }}</p>
                                    <p>住所1(市町村など):{{ optional($payment->user->address)->city }}</p>
                                    <p>住所2(番地など):{{ optional($payment->user->address)->block }}</p>
                                    <p>住所3(建物番号など):{{ optional($payment->user->address)->building }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    {{ optional($payment->inviter)->name }}
                </td>
                <td>
                    {{ $payment->price }}円
                </td>
                <td>
                    {{ $payment->project->user->name }}
                </td>
                <td>
                    {{ $payment->project->title }}
                </td>
                <td>
                    <a class="btn btn-primary mt-1" data-toggle="modal"
                                data-target="#return_index{{ $payment->id }}">
                                リターン一覧
                    </a>
                    <div class="modal fade" id="return_index{{ $payment->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="return_content_modal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="return_content_modal">
                                        <a href="{{ route('admin.plan.index', ['project' => $payment->project->id]) }}">
                                        {{ $payment->project->title }}
                                        </a>から購入したリターン一覧
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @foreach ($payment->includedPlans as $plan)
                                        {{ $plan->title }} </br>個数 : {{ $plan->pivot->quantity }}<br/><br/>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#messageModal{{ $loop->iteration }}">
                        メッセージ
                    </button>
                    @if ($payment->message_status !== '対応済')
                    <small style="display: block;color:red">
                        {{ $payment->message_status }}
                    </small>
                    @else
                    <small style="display: block">
                        {{ $payment->message_status }}
                    </small>
                    @endif
                    {{-- <a class="btn btn-primary"
                        href="{{route('admin.message.show',['message' => $payment])}}">メッセージ</a> --}}
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
                                    {{-- <x-common.message.message_viewer :selectedMessage="$payment" guard="admin" /> --}}
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
            {{ $payments->appends(request()->input())->links() }}
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
