@extends('user.layouts.base')

@section('content')

@section('content')

<div class="content sub_content detail_content">
    <div class="fixedcontainer">
        <h2 class="sec-ttl">{{ $plan->title }}</h2>

        <div class="fixedcontainer mypage_contents profile_box">
            <form action="{{ route('user.plan.address.confirm', ['project' => $project, 'plan' => $plan]) }}" method="post">
                @csrf
                @if($plan->necessary_address)
                <h2>郵送先入力画面/オプション選択</h2>

                {{-- デフォルト住所選択 --}}
                <div class="form-group i_form_item radio_item">
                    <div class="radio_item_tit">郵送先選択</div>
                    <div class="radio_item_main">
                        @foreach($default_addresses as $address)
                            <label class="btn active">
                                <input type="radio" name="address_type" value="{{ $address->id }}" {{old("address_type") == $address->id || !$errors->any() && $loop->first ? "checked" : ""}}><i class="far fa-circle fa-2x  address-radio" id="default-address"></i><i class="far fa-dot-circle fa-2x"></i><span>設定している住所を利用する</span>
                                <div style="margin-left: 22px; width: 100%;"><span>住所：</span>{{ $address->postal_code ."  ".$address->address }}</div>
                            </label>
                        @endforeach
                        <label class="btn">
                            <input type="radio" name="address_type" value="other_address"  {{  count($default_addresses) === 0 || old("address_type") === "other_address" ? "checked" : "" }}><i class="far fa-circle fa-2x address-radio"  id="other-address"></i><i class="far fa-dot-circle fa-2x"></i><span>新しい住所を追加する</span>
                        </label>
                    </div>
                </div>

                {{-- 新しい住所入力 --}}
                <div class="form-group">
                    <label class="control-label" for="sample_01">郵便番号(7桁ハイフンあり)
                    </label>
                    <input class="form-control postal-code" placeholder="郵便番号" type="text" name="zip11" id="sample_01" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');" value="{{ old('zip11') }}">
                </div>

                <div class="form-group">
                    <label class="control-label" for="sample_01">住所
                        </label>
                        <input class="form-control address" placeholder="住所" type="text" id="sample_01" name="addr11" size="60" value="{{ old('addr11') }}">
                </div>

                <div class="form-group">
                    <label class="control-label" for="sample_01">番地、建物
                        </label>
                        <input class="form-control building" placeholder="番地、建物" type="text" id="sample_01" name="address" size="60" value="{{ old('address') }}">
                </div>

                <div class="form-group">
                    <label class="control-label" for="sample_01">電話番号(ハイフンあり)
                    </label>
                    @if(isset($user->userDetail->phone_number))
                    <input class="form-control postal-code" placeholder="電話番号" type="text" name="phone_number" id="sample_01" size="13" maxlength="13" value="{{ old('phone_number', $user->userDetail->phone_number) }}">
                    @else
                    <input class="form-control postal-code" placeholder="電話番号" type="text" name="phone_number" id="sample_01" size="13" maxlength="13" value="{{ old('phone_number') }}">
                    @endif
                </div>
                @else
                <h2>オプション選択</h2>
                @endif

                <div class="form-group">
                    <label class="control-label">オプション選択</label>
                    <div class="select_item_main">
                        <select name="selected_option">
                            @foreach($plan->options as $option)
                            <option value="{{ $option->name }}">{{ $option->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="submit-box-address">
                    <div class="plan-btn-wrap address-submit-wrap"><button class="plan-btn address-submit" type="submit" name="settlement" value="settlement">決済方法画面へ</button></div>
                    @if($plan->necessary_address)
                    <div class="plan-btn-wrap address-submit-wrap"><button class="delete-submit-address" type="submit" name="delete" value="delete">住所を削除</button></div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@section('script')
<!-- 住所入力 -->
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>

<!-- 住所入力の際のjs -->
<script>
$(function(){
    // ラジオボタンのクリックイベントを取得
    $(".address-radio").click( function(){

        var el = $(this);
        // ラジオボタンがデフォのアドレスか別のアドレスか取得
        var AddressType = el.attr('id');

        // デフォならボタンをピンクに
        if (AddressType === "default-address"){
            $(".my-page_btn").css('background-color', '#ff1493');
        }

        // 新しい住所なら住所情報が全て入力されていたらボタンをピンクに
        if (AddressType === "other-address"){
            console.log($('input.postal-code'));
            if ($('.postal-code').val() !== "" && $(".address").val() !== "" && $(".building").val() !== ""){
                $(".my-page_btn").css('background-color', '#ff1493');
            } else {
                $(".my-page_btn").css('background-color', '#999');
            }
        }
    });

    // inputからフォーカスが外れたら全ての情報が入力されていたらボタンをピンクに
    $('input').blur(function(){
        var PostalCode = $('input.postal-code').val();
        var Address = $('input.address').val();
        var Building = $('input.building').val();
        if (PostalCode !== "" && Address !== "" && Building !== ""){
            $(".my-page_btn").css('background-color', '#ff1493');
        } else {
            $(".my-page_btn").css('background-color', '#999');
        }
    });
});
</script>
@endsection
@endsection
