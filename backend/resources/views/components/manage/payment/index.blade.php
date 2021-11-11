@extends($guard.'.layouts.base')

@section('title', '支援者(ファン)管理')

@section('content')

<div class="card-header d-flex flex-column">
    <div class="flex-grow-1">
        支援者(ファン)管理
        <x-manage.display_index_count :props="$payments" />
    </div>
    <form action="{{ route('admin.payment.index') }}" class="form-inline pr-3" method="get" style="position: relative">
        @if(Request::get('project'))
            <input type="hidden" name="project" value="{{ Request::get('project') }}" />
        @endif
        <p>
            <a class="btn btn-secondary mt-3 mr-2" data-toggle="collapse" href="#collapseExample" role="button"
                aria-expanded="false" aria-controls="collapseExample">
                詳細条件 ▼
            </a>
        </p>
        <div class="collapse" id="collapseExample" style="position: absolute; top: 55px; left: -100px;">
            <div class="card card-body">
                <div class="form-group mb-2 flex-column">
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">オーダーID</span>
                        </div>
                        <input type="text" class="form-control" value="{{ Request::get('order_id') }}"
                            name="order_id" id="order_id">
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
        <select name="job_cd" id="job_cd" class="form-control mr-2">
            <option value="" {{ !Request::get('job_cd') ? 'selected' : '' }}>
                処理状況</option>
            @foreach(PaymentJobCd::getValues() as $job_cd)
                <option {{ Request::get('job_cd') === PaymentJobCd::fromValue($job_cd)->key ? 'selected' : '' }} value="{{ PaymentJobCd::fromValue($job_cd)->key }}">
                    {{ $job_cd }}
                </option>
            @endforeach
        </select>
        <x-manage.sort_form :props_array="[
            'created_at' => '支援時刻',
            'user_name' => '支援者名',
            'inviter_name' => '招待者名',
            'price' => '支援額',
            {{-- 'plan_payment_included_plan_project_user_name' => 'インフルエンサー名',
            'plan_payment_included_plan_project_title' => 'プロジェクト名', --}}
        ]" />
        <input name="word" type="search" class="form-control mr-2" aria-lavel="Search" placeholder="キーワードで検索"
            value="{{ Request::get('word') }}">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
    </form>
</div>
<x-manage.search-terms role='admin' model='payment' />
<div class="card-body">
    @if($payments->count() <= 0)
        <p>表示する投稿はありません。</p>
    @else
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            <div class="d-flex">
                @if(Request::get('project'))
                    <form action="{{ route('admin.project.output_purchases_list_to_csv', ['project' => Request::get('project')]) }}" class="mr-4">
                        @csrf
                        <button class="btn btn-secondary mb-4">CSV出力</button>
                    </form>
                    <form action="{{ route('admin.payment.alter_sales', ['project' => Request::get('project')]) }}" method="POST" class="mr-4">
                        @csrf
                        <button class="btn btn-success mb-4" onclick="return confirm('実売上計上を行うと確保していた与信枠は無くなってしまいます。本当に実売上計上してもよろしいでしょうか。')" type="submit">
                            実売上計上
                        </button>
                    </form>
                    <form action="{{ route('admin.payment.alter_cancel', ['project' => Request::get('project')]) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger mb-4" onclick="return confirm('売上キャンセルを行うと確保していた与信枠は無くなってしまいます。本当に売上キャンセルしてもよろしいでしょうか。')" type="submit">
                            売上キャンセル
                        </button>
                    </form>
                @endif
            </div>
            <div>
                <p class="mb-0">※画面サイズが足りない場合は横にスクロールが可能です。</p>
                <p class="mb-0">※仮売上状態（オーソリ）は60日までです。</p>
                <p class="mb-0">※売上キャンセルはプロジェクトの掲載開始期間から</p>
                <p class="mb-0">130日以内に実行してください。</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" width="10%" class="text-nowrap">オーダーID</th>
                        <th scope="col" width="10%" class="text-nowrap">処理状況</th>
                        <th scope="col" width="10%" class="text-nowrap">支援時刻</th>
                        <th scope="col" width="10%" class="text-nowrap">支援者名</th>
                        <th scope="col" width="10%" class="text-nowrap">招待者名</th>
                        <th scope="col" width="10%" class="text-nowrap">支援額</th>
                        <th scope="col" width="10%" class="text-nowrap">インフルエンサー名</th>
                        @if(!Request::get('project'))
                            <th scope="col" width="10%" class="text-nowrap">プロジェクト名</th>
                        @endif
                        <th scope="col" width="10%" class="text-nowrap">購入リターン</th>
                        <th scope="col" width="10%" class="text-nowrap">メッセージ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <th scope="row">
                            <a href="{{ config('app.gmo_payment_detail_url') }}/{{ $payment->paymentToken->order_id }}/?page=1" target="_blank">
                                {{ $payment->paymentToken->order_id }}
                            </a>
                        </th>
                        <td>
                            <p class="text-nowrap
                                {{ $payment->gmo_job_cd === 'AUTH' ? 'text-secondary' : '' }}
                                {{ $payment->gmo_job_cd === 'SALES' ? 'text-success' : '' }}
                                {{ $payment->gmo_job_cd === 'VOID' ? 'text-danger' : '' }}
                            ">
                                {{ PaymentJobCd::fromKey($payment->gmo_job_cd) }}
                            </p>
                        </td>
                        <td class="text-nowrap">
                            {{ $payment->created_at }}
                        </td>
                        <td>
                            <a class="mt-1 text-nowrap" data-toggle="modal"
                                        data-target="#support_user_index{{ $payment->user->id }}">
                                {{ $payment->user->name }}
                            </a>
                            <div class="modal fade" id="support_user_index{{ $payment->user->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="user_content_modal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="user_content_modal">
                                                {{ $payment->user->name }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>電話番号:
                                                <a href="tel:{{ optional($payment->user->profile)->phone_number }}">
                                                    {{ optional($payment->user->profile)->phone_number }}
                                                </a>
                                            </p>
                                            <p>E-mail:<a href="mailto:{{ $payment->user->email }}">{{ $payment->user->email }}</a></p>
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
                        <td class="text-nowrap">
                            {{ $payment->price }}円
                        </td>
                        <td>
                            <a class="mt-1 text-nowrap" data-toggle="modal" data-target="#project_user_index{{ $payment->project->user->id }}">
                                {{ $payment->project->user->name }}
                            </a>
                            <div class="modal fade" id="project_user_index{{ $payment->project->user->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="user_content_modal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="user_content_modal">
                                                {{ $payment->project->user->name }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>電話番号:
                                                <a href="tel:{{ optional($payment->project->user->profile)->phone_number }}">
                                                    {{ optional($payment->project->user->profile)->phone_number }}
                                                </a>
                                            </p>
                                            <p>Email:<a href="mailto:{{ $payment->project->user->email }}">{{ $payment->project->user->email }}</a></p>
                                            <p>StripeのアカウントID: {{ optional($payment->project->user->identification)->connected_account_id }}</p>
                                            <p>プロフィール画像:
                                                <div class="text-center">
                                                    <img style="max-height:15vw; object-fit: contain;"
                                                        src="{{ Storage::url(optional($payment->project->user->profile)->image_url) }}">
                                                </div>
                                            </p>
                                            <p>SNS:
                                                <div class="d-flex justify-content-around">
                                                    @if (optional($payment->project->user->snsLink)->twitter_url)
                                                    <a href="{{ optional($payment->project->user->snsLink)->twitter_url }}"><img src="{{ asset('image/twitter.png') }}" alt="" height="48px" width="48px"></a>
                                                    @endif
                                                    @if (optional($payment->project->user->snsLink)->instagram_url)
                                                    <a href="{{ optional($payment->project->user->snsLink)->instagram_url }}"><img src="{{ asset('image/instagram.png') }}" alt="" height="48px" width="48px"></a>
                                                    @endif
                                                    @if (optional($payment->project->user->snsLink)->youtube_url)
                                                    <a href="{{ optional($payment->project->user->snsLink)->youtube_url }}"><img src="{{ asset('image/youtube.png') }}" alt="" height="48px" width="48px"></a>
                                                    @endif
                                                    @if (optional($payment->project->user->snsLink)->tiktok_url)
                                                    <a href="{{ optional($payment->project->user->snsLink)->tiktok_url }}"><img src="{{ asset('image/tiktok.png') }}" alt="" height="48px" width="48px"></a>
                                                    @endif
                                                    @if (optional($payment->project->user->snsLink)->other_url)
                                                    <a href="{{ optional($payment->project->user->snsLink)->other_url }}"><img src="{{ asset('image/other_sns.png') }}" alt="" height="48px" width="48px"></a>
                                                    @endif
                                                </div>
                                            </p>
                                            <p>姓:{{ optional($payment->project->user->profile)->last_name }}</p>
                                            <p>名:{{ optional($payment->project->user->profile)->first_name }}</p>
                                            <p>姓(カナ):{{ optional($payment->project->user->profile)->last_name_kana }}</p>
                                            <p>名(カナ):{{ optional($payment->project->user->profile)->first_name_kana }}</p>
                                            <p>生年月日:{{ optional($payment->project->user->profile)->birthday }}</p>
                                            <p>公開状態:{{ optional($payment->project->user->profile)->birthday_is_published ?'公開中':'非公開中' }}</p>
                                            <p>性別:{{ optional($payment->project->user->profile)->gender }}</p>
                                            <p>公開状態:{{ optional($payment->project->user->profile)->gender_is_published ?'公開中':'非公開中' }}</p>
                                            <p>紹介文:{{ optional($payment->project->user->profile)->introduction }}</p>
                                            <p></p>
                                            <p>郵便番号:{{ optional($payment->project->user->address)->postal_code }}</p>
                                            <p>都道府県:{{ optional($payment->project->user->address)->prefecture }}</p>
                                            <p>住所1(市町村など):{{ optional($payment->project->user->address)->city }}</p>
                                            <p>住所2(丁目など):{{ optional($payment->project->user->address)->block }}</p>
                                            <p>住所3(番地など):{{ optional($payment->project->user->address)->block_number }}</p>
                                            <p>住所4(建物番号など):{{ optional($payment->project->user->address)->building }}</p>
                                            <div class="card-header">本人確認項目</div>
                                            <p>金融機関コード:{{ optional($payment->project->user->identification)->bank_code }}</p>
                                            <p>支店コード:{{ optional($payment->project->user->identification)->branch_code }}</p>
                                            <p>口座種別:{{ optional($payment->project->user->identification)->account_type }}</p>
                                            <p>口座番号:{{ optional($payment->project->user->identification)->account_number }}</p>
                                            <p>口座名義人名:{{ optional($payment->project->user->identification)->account_name }}</p>
                                            <p>本人確認書類１:</p>
                                            <span class="text-danger">※クリックすると画像をダウンロードできます。</span>
                                            <div class="text-center">
                                                <a class="text-center" href="{{ route('admin.user.download_identify_image', ['user' => $payment->project->user, 'column_name' => 'identify_image_1']) }}">
                                                    <img style="max-height:15vw; object-fit: contain;"
                                                        src="{{ Storage::url(optional($payment->project->user->identification)->identify_image_1) }}">
                                                </a>
                                            </div>
                                            <p>本人確認書類２:</p>
                                            <span class="text-danger">※クリックすると画像をダウンロードできます。</span>
                                            <div class="text-center">
                                                <a href="{{ route('admin.user.download_identify_image', ['user' => $payment->project->user, 'column_name' => 'identify_image_2']) }}">
                                                    <img style="max-height:15vw; object-fit: contain;"
                                                        src="{{ Storage::url(optional($payment->project->user->identification)->identify_image_2) }}">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        @if(!Request::get('project'))
                            <td class="text-nowrap">
                                {{ Str::limit($payment->project->title, 30) }}
                            </td>
                        @endif
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
                </tbody>
            </table>
        </div>
        {{ $payments->appends(request()->input())->links() }}
    @endif
</div>
@endsection

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
