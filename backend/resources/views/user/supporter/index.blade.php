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

        <div class="prof_page_R scrollable">
            <div>
                <div class="send_btn my_project_apply">
                    <form action="{{ route('user.send_to_supporter', ['project' => $project]) }}" method="POST">
                        @csrf
                        発送済みにする
                        <button type="submit" class="cover_link disable-btn"></button>
                </div>
            </div>
            <table>
                <tr>
                    <th>発送状況</th>
                    <th>支援者名</th>
                    <th>住所</th>
                    <th>メールアドレス</th>
                    <th>購入したリターン</th>
                </tr>
                @if($project->payments)
                    @foreach($project->payments as $payment)
                    <tr class="edit_row">
                        <td>
                            @if ($payment->is_sent)
                                発送済み
                            @else
                                <input type="checkbox" id="payment_{{ $payment->id }}" class="ac_list_checks" name="payment_ids[]" value="{{ $payment->id }}">
                                <label for="payment_{{ $payment->id }}" class="checkbox-fan">
                                    発送待ち
                                </label>
                            @endif
                        </td>
                        <td class="supporter_name">
                            <span>{{ $payment->user->name }}</span>
                            <i class="fas fa-copy" style="cursor: pointer" onclick="copyInnerText(this.previousElementSibling);displayToast('success','','コピーが完了しました。')"></i>
                        </td>
                        <td>
                            <span class="formatted_postal_code">
                                {{ $payment->user->address->formatted_postal_code }}<br>
                                {{ $payment->user->address->full_address }}
                            </span>
                            <i class="fas fa-copy" style="cursor: pointer" onclick="copyInnerText(this.previousElementSibling);displayToast('success','','コピーが完了しました。')"></i>
                        </td>
                        <td>
                            <span>
                                {{ $payment->user->email }}
                            </span>
                            <i class="fas fa-copy" style="cursor: pointer" onclick="copyInnerText(this.previousElementSibling);displayToast('success','','コピーが完了しました。')"></i>
                        </td>
                        <td>
                            <a onClick="display.planDetail({{ $payment->id }})"><span class="accordion__title" style="font-size: 1.4rem;font-weight: bold;background-color:#F7FDFF;color:#00aebd;margin:10px 0px 0 0;padding:12px 10px; white-space: nowrap;">一覧</span></a>
                        </td>
                    </tr>
                    <tr class="plan_detail">
                        <td id="display_plan_detail_{{ $payment->id }}" style="display:none;" colspan="4">
                            <i class="fas fa-copy" style="cursor: pointer" onclick="copyInnerText(this.nextElementSibling);displayToast('success','','コピーが完了しました。')"></i>
                            <ul>
                                @foreach($payment->includedPlans as $plan)
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
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </table>
            </form>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src={{ asset('/js/copy-inner-text.js') }}></script>
<script src={{ asset('/js/display.js') }}></script>
<script src={{ asset('/js/display-toast.js') }}></script>
@endsection