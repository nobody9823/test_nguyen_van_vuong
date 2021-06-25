@if ($errors->any())
<div class="error-message text-center">
    <ul class="error-message-list">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('user.plan.confirmPayment', ['project' => $project]) }}" class="h-adr">
    <input type="hidden" class="p-country-name" value="Japan">
    <div class="plan-div">
        <h2>応援プラン</h2>
        @foreach($project->plans as $plan)
            <x-user.plan-card :plan="$plan" :project="$project" />
        @endforeach
    </div>
    <div>
        <input type="radio" id="huey" name="payment_way" value="credit">
        <label>Credit</label>

        <input type="radio" id="dewey" name="payment_way" value="paypay">
        <label>PayPay</label>
    </div>

    <div>
        <label for="">姓(全角)</label>
        <input type="text" name="first_name">
        <label for="">名(全角)</label>
        <input type="text" name="last_name">
        <label for="">セイ(全角)</label>
        <input type="text" name="first_name_kana">
        <label for="">メイ(全角)</label>
        <input type="text" name="last_name_kana">
        <label for="">メールアドレス</label>
        <input type="email" name="email">
        <label for="">性別</label>
        <select name="gender">
            <option value="select">選択</option>
            <option value="男性">男性</option>
            <option value="女性">女性</option>
            <option value="その他">その他</option>
        </select>
        <label for="">電話番号(ハイフンなし)</label>
        <input type="number" name="phone_number">
        <label for="">郵便番号(ハイフンなし)</label>
        <input type="number" name="postal_code" onKeyUp="AjaxZip2.zip2addr(this,'prefecture','address');" class="p-postal-code">
        <label for="">都道府県</label>
        <select name="prefecture" class="p-region">
                <option value="non_selected">選択してください</option>
            @for($i = 1; $i <= 47; $i++)
                <option value="{{ PrefectureHelper::getPrefectures()[$i] }}">{{ PrefectureHelper::getPrefectures()[$i] }}</option>
            @endfor
        </select>
        <label>市町村</label>
        <input type="text" name="city" class="p-locality" readonly /><br>
        <label>番地</label>
        <input type="text" name="block" class="p-street-address" /><br>
        <label>建物名</label>
        <input type="text" name="building" class="p-extended-address" />
        <label for="birth_year" class="col-md-4 control-label">生年月日</label>
        <select id="birth_year" class="form-control" name="birth_year">
            <option value="">----</option>
            @for ($i = 1980; $i <= 2005; $i++)
            <option value="{{ $i }}"@if(old('birth_year') == $i) selected @endif>{{ $i }}</option>
            @endfor
        </select>

        <select id="birth_month" class="form-control" name="birth_month">
            <option value="">--</option>
            @for ($i = 1; $i <= 12; $i++)
            <option value="{{ $i }}"@if(old('birth_month') == $i) selected @endif>{{ $i }}</option>
            @endfor
        </select>

        <select id="birth_day" class="form-control" name="birth_day">
            <option value="">--</option>
            @for ($i = 1; $i <= 31; $i++)
            <option value="{{ $i }}"@if(old('birth_day') == $i) selected @endif>{{ $i }}</option>
            @endfor
        </select>
        <label for="">備考欄</label>
        <input type="text" name="remarks">
        <label for="">任意コメント</label>
        <input type="text" name="comments">
    </div>
    <button type="submit">決済する</button>
</form>
<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" type="text/javascript" charset="UTF-8"></script>
<script>
window.onload = function(){
    if (window.performance.navigation.type == 2){
        Plans.searchCheckedPlans();
    }
}
</script>
<script src="{{ asset('/js/Plans.js') }}"></script>