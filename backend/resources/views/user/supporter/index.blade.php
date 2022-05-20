@extends('user.layouts.base')

@section('title', '支援者一覧')

@section('content')
<section id="supported-projects" class="section_base">
    <div class="tit_L_01 E-font">
        <h2>SUPPORTERS</h2>
        <div class="sub_tit_L">支援者一覧</div>
        <div class="ps_description" style="margin-top: 20px">
            <h5 style="color: #e65d65">※「要求成功」ステータスでは購入は完了しておりません。</h5>
            <h5 style="color: #e65d65">「決済完了」ステータスのみリターンをご発送ください。</h5>
        </div>
    </div>


    <div class="prof_page_base inner_item supporters">
        <div class="prof_page_L">
            <x-user.mypage-navigation-bar/>
        </div>

        <div class="prof_page_R">
            <form action="{{ route('user.send_to_supporter', ['project' => $project]) }}" method="POST">
                @csrf
                <table class="supporters_table">
                    <thead>
                        <tr>
                            <th>
                                <div class="send_btn">
                                    発送済にする
                                    <button type="submit" class="cover_link disable-btn"></button>
                                </div>
                                <div class="supporters_tooltip1" ontouchstart="">
                                    <p class="supporters_tooltip_icon">？</p>
                                    <div class="supporters_description1">
                                        各支援者の方へのリターンの発送状況のステータスとなります。
                                        <br/>
                                        <br/>
                                        発送が完了次第ステータスを「発送済」へと変更してください。
                                    </div>
                                </div>
                            </th>
                            <th>
                                <p style="font-size: smaller">ステータス</p>
                                <div class="supporters_tooltip1" ontouchstart="">
                                    <p class="supporters_tooltip_icon">？</p>
                                    <div class="supporters_description2">
                                        各支援者の支払い処理状況のステータスとなります。
                                        <br/>
                                        <br/>
                                        クレジット決済の場合は「仮売上」または「実売上」状態のステータスであれば決済が完了しております。
                                        <br/>
                                        <br/>
                                        コンビニ決済の場合は支援者に振り込み依頼のメール送信完了で「要求成功」、支援者のコンビニでの振り込みが完了した状態で「決済完了」、振り込みがされずに支払い期限が過ぎてしまった状態で「期限切れ」となります。
                                        <br/>
                                        <br/>
                                        <p class="supporters_tooltip_alert">
                                            ※期限を超えた場合はキャンセルになるためリターン内容と支払い状況をご確認の上、発送の際にはご注意ください。
                                            <br/>
                                            また、達成金額についても「期限切れ」となってしまった場合は購入自体キャンセルとなり、達成金額が変わることにもご注意ください。
                                        </p>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <p>支援者名</p>
                                <div class="supporters_tooltip1" ontouchstart="">
                                    <p class="supporters_tooltip_icon">？</p>
                                    <div class="supporters_description3">
                                        <i class="fas fa-plus-square" style="color: #00AEBD; background-color: #fff; font-size: 24px; line-height: inherit;"></i>
                                        を押すことで各支援者の詳細情報が確認できます。
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($paymentPlans)
                        @foreach($paymentPlans as $key => $payments)
                        <tr style="display:block">
                            <td style="width: 100%;">{{ $namePlans[$key] }}</td>
                        </tr>
                        @foreach($payments as $payment)
                        <tr class="edit_row">
                            <td>
                                @if ($payment->is_sent)
                                    <p class="sent_return">
                                        <i class="fas fa-check-circle"></i>
                                        発送済
                                    </p>
                                @else
                                    <input type="checkbox" id="payment_{{ $payment->id }}" class="ac_list_checks" name="payment_ids[]" value="{{ $payment->id }}">
                                    <label for="payment_{{ $payment->id }}" class="checkbox-fan">
                                        未発送
                                    </label>
                                @endif
                            </td>
                            <td>
                                <p style="
                                    {{ ($payment->gmo_job_cd === 'AUTH' || $payment->gmo_job_cd === 'REQSUCCESS') ? 'color: #6c757d;' : '' }}
                                    {{ ($payment->gmo_job_cd === 'SALES' || ($payment->gmo_job_cd === 'PAYSUCCESS' && $payment->payment_is_finished)) ? 'color: #38c172;' : '' }}
                                    {{ ($payment->gmo_job_cd === 'VOID'
                                        || $payment->gmo_job_cd === 'RETURN'
                                        || $payment->gmo_job_cd === 'RETURNX'
                                        || $payment->gmo_job_cd === 'FAILED'
                                        || $payment->gmo_job_cd === 'EXPIRED'
                                        || ($payment->gmo_job_cd === 'PAYSUCCESS' && !$payment->payment_is_finished)
                                        || $payment->gmo_job_cd === 'CANCEL')
                                            ? 'color: #38c172;'
                                            : ''
                                    }}
                                ">
                                    @if($payment->payment_way === 'cvs' && $payment->gmo_job_cd === 'PAYSUCCESS' && !$payment->payment_is_finished)
                                        メール送金で返金済み
                                    @else
                                        {{ PaymentJobCd::fromKey($payment->gmo_job_cd) }}
                                    @endif
                                </p>
                            </td>
                            <td>
                                <i class="fas fa-plus-square" style="color: #00AEBD; padding-right: 3px; cursor: pointer; font-size: 24px;" onclick="openSupporterModal({{ $payment->id }})"></i>
                                <p>{{ $payment->user->name }}</p>
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</section>
@if($project->payments)
    @foreach($project->payments as $payment)
    <section class="plan_form_modal" id="supporter_modal_{{ $payment->id }}">
        <div class="plan_form_modal_bg" onclick="closeSupporterModal({{ $payment->id }})"></div>
        <div class="plan_form_modal_content">
            <div class="tit_L_01 E-font">
                <h2>SUPPORTERS DETAIL</h2>
                <div class="sub_tit_L">詳細情報</div>
            </div>
            <div class="supporters_wrapper">
                <p class="notification">
                    <i class="fas fa-copy" style="color: #00AEBD; padding-left: 3px;font-size: 24px;"></i>
                    を押すことで各情報をコピーすることができます
                </p>
            </div>
            <div class="supporters_info_item">
                <p onclick="copyInnerText(this.nextElementSibling);displayToast('success','','コピーが完了しました。')">
                    <i class="fas fa-copy"></i>
                    ユーザー名
                </p>
                <span>
                    {{ $payment->user->name }}
                </span>
            </div>
            <div class="supporters_info_item">
                <p onclick="copyInnerText(this.nextElementSibling);displayToast('success','','コピーが完了しました。')">
                    <i class="fas fa-copy"></i>
                    フリガナ
                </p>
                <span>
                    {{ $payment->includedAddress()->first()->last_name_kana }} {{ $payment->includedAddress()->first()->first_name_kana }}
                    {{-- {{ $payment->user->profile->last_name_kana }} {{ $payment->user->profile->first_name_kana }} --}}
                </span>
                <p onclick="copyInnerText(this.nextElementSibling);displayToast('success','','コピーが完了しました。')">
                    <i class="fas fa-copy"></i>
                    氏名
                </p>
                <span>
                    {{ $payment->includedAddress()->first()->last_name }} {{ $payment->includedAddress()->first()->first_name }}
                    {{-- {{ $payment->user->profile->last_name }} {{ $payment->user->profile->first_name }} --}}
                </span>
            </div>
            <div class="supporters_info_item">
                <p onclick="copyInnerText(this.nextElementSibling);displayToast('success','','コピーが完了しました。')">
                    <i class="fas fa-copy"></i>
                     電話番号
                </p>
                <span>
                    {{ $payment->includedAddress()->first()->phone_number }}
                    {{-- {{ $payment->user->profile->phone_number }} --}}
                </span>
            </div>
            <div class="supporters_info_item">
                <p onclick="copyInnerText(this.nextElementSibling);displayToast('success','','コピーが完了しました。')">
                    <i class="fas fa-copy"></i>
                     メールアドレス
                </p>
                <span>
                    {{ $payment->user->email }}
                </span>
            </div>
            <div class="supporters_info_item">
                <p onclick="copyInnerText(this.nextElementSibling);displayToast('success','','コピーが完了しました。')">
                    <i class="fas fa-copy"></i>
                    住所
                </p>
                <span class="formatted_postal_code">
                    〒{{ $payment->includedAddress()->first()->formatted_postal_code }}
                    {{ $payment->includedAddress()->first()->full_address }}
                </span>
            </div>
            <div class="supporters_info_item">
                <p onclick="copyInnerText(this.nextElementSibling);displayToast('success','','コピーが完了しました。')">
                    <i class="fas fa-copy"></i>
                    支援内容
                </p>
                <div>
                    <div class="su_pr_02">
                        <div class="supporters_payment_info">
                            <div>
                                <span>支援総額 : </span>{{ number_format($payment->price) }}円
                            </div>
                            <div>
                                <span>上乗せ金額 : </span>{{ number_format($payment->added_payment_amount) }}円
                            </div>
                            <div>
                                <span>オーダーID : </span>{{ $payment->paymentToken->order_id }}
                            </div>
                        </div>
                    </div>
                    @foreach($payment->includedPlans as $plan)
                    <div class="su_pr_02 supporters_purchased_return_info">
                        <div class="su_pr_02_01 m_b_1510">購入リターン{{ $loop->iteration }}</div>
                        <div class="su_pr_02_02 m_b_1510">{{ $plan->title }}</div>
                        <div class="su_pr_02_03 m_b_1510">
                            <div><span>支払い総額</span><br>{{ number_format( $plan->pivot->quantity * $plan->price ) }}円</div>
                            <div><span>商品単価</span><br>{{ number_format( $plan->price ) }}円</div>
                            <div><span>数量</span><br>{{ $plan->pivot->quantity }}個</div>
                        </div><!--/su_pr_02_03-->
                        <div class="su_pr_02_04 m_b_1510">
                            <div>支援日：{{ DateFormat::forJapanese($payment->created_at) }}</div>
                            <div>お届け：{{ $plan->formatted_delivery_date }}末までにお届け予定</div>
                        </div><!--/su_pr_02_04-->
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="supporters_info_item">
                <p onclick="copyInnerText(this.nextElementSibling);displayToast('success','','コピーが完了しました。')">
                    <i class="fas fa-copy"></i>
                    備考
                </p>
                <span>
                    {{ $payment->remarks }}
                </span>
            </div>
            <div class="supporters_info_item">
                <p onclick="copyInnerText(this.nextElementSibling);displayToast('success','','コピーが完了しました。')">
                    <i class="fas fa-copy"></i>
                    応援コメント
                </p>
        @if($project->comments)
            @foreach($project->comments as $comment)
                @if($payment->user->id == $comment->user_id)
                <span>
                    {{ $comment->content }}
                </span>
                @endif
            @endforeach
        @endif
            </div>
        </div>
    </section>
    @endforeach
@endif
@endsection
@section('script')
<script src={{ asset('/js/copy-inner-text.js') }}></script>
<script src={{ asset('/js/display-toast.js') }}></script>
<script src={{ asset('/js/fade-element.js') }}></script>
<script src={{ asset('/js/supporter-modal.js') }}></script>
@endsection
