@extends('user.layouts.base')

@section('title', '支援者一覧')

@section('content')
<section id="supported-projects" class="section_base">

    <div class="tit_L_01 E-font">
        <h2>SUPPORTERS</h2>
        <div class="sub_tit_L">支援者一覧</div>
    </div>

    <div class="prof_page_base inner_item supporters">
        <div class="prof_page_L">
            <x-user.mypage-navigation-bar/>
        </div>

        <div class="prof_page_R">
            <table>
                <tr>
                    <th>支援者名</th>
                    <th>住所</th>
                    <th>メールアドレス</th>
                    <th>購入したリターン</th>
                </tr>
                @if($project->payments)
                    @foreach($project->payments as $payment)
                    <tr class="edit_row">
                        <td>
                            <a onClick="copyText.copy(this)">
                                {{ $payment->user->name }}
                            </a>
                        </td>
                        <td>
                            <a onClick="copyText.copy(this)">
                                {{ $payment->user->address->postal_code .' '. $payment->user->address->prefecture . $payment->user->address->city . $payment->user->address->block . $payment->user->address->building }}
                            </a>
                        </td>
                        <td>
                            <a onClick="copyText.copy(this)">
                                {{ $payment->user->email }}
                            </a>
                        </td>
                        <td>
                            <a onClick="display.planDetail({{ $payment->id }})"><p class="accordion__title accordion__arrow" style="font-size: 1.4rem;font-weight: bold;background-color:#F7FDFF;color:#00aebd;margin:10px 0px 0 0;padding:12px 10px;">やりとりしている支援者</p></a>
                        </td>
                        <td id="display_plan_detail_{{ $payment->id }}" style="display:none;">
                            <ul>
                                @foreach($payment->includedPlans as $plan)
                                    <a onClick="copyText.copy(this)">
                                        <li>
                                            タイトル : {{ $plan->title }}
                                        </li>
                                        <li>
                                            {{ $plan->content }}
                                        </li>
                                        <li>
                                            価格 : {{ $plan->price }}
                                        </li>
                                        <li>
                                            お届け予定日：{{ $plan->delivery_date }}
                                        </li>
                                        <li>
                                            個数：{{ $plan->pivot->quantity }}
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src={{ asset('/js/copyText.js') }}></script>
<script src={{ asset('/js/display.js') }}></scrip>
@endsection