<form action="{{ route('user.my_project.project.update', ['project' => $project, 'current_tab' => 'ps_return']) }}" method="post">
    @csrf
    @method('PUT')
    <div class="ps_description">
        <h4 style="color: #e65d65">以下の注意事項をご確認ください。</h4>
        <ul>
            <li>
                PSリターン獲得の条件は、支援者がプロジェクトサポーター(PS)となってプロジェクトページへのリンクをSNSで紹介し、別のユーザーがそのリンクによって集まった支援の総額が「支援総額」購入されたリターンの合計個数が「支援件数」として、それぞれの順位によって獲得ができます。
            </li>
            <li>
                支援者の方により多くのSNSでの紹介を行っていただくために、PSリターンには通常のリターンとは違った特別なリターンを設定してください。
            <br/>
                また、リターン内容はなるべく支援者にコストのかからないイベント/体験型のリターンを設定してください。
            <br/>
                例) 紹介支援総額上位３名で、お礼イベント開催。
            </li>
            <li>
                <a href="{{ route('user.my_project.reward_sample') }}" target="_blank">こちらからサンプルを確認できます。</a>
            </li>
        </ul>
        {{-- <strong>1枚（表面）</strong>
        <ul>
            <li>個人番号カード/マイナンバーカード（表面のみ。通知カードは不可）</li>
            <li>在留カード</li>
            <li>
                住民票の写し<br/>
                ※本籍・マイナンバーの表記がないもの
            </li>
        </ul> --}}
    </div>
    <div class="ps_plan_form_wrapper">
        <div class="ps_plan_form_item">
            <div class="form_item_tit">支援総額順リターン内容<span class="hissu_txt">必須</span><span class="disclaimer">※300文字以内で入力してください</span></div>
            <div class="spinner-wrapper">
                <div class="spinner" id="spinner_reward_by_total_amount"></div>
                <i class="fa fa-check-circle green" aria-hidden="true" style="display: none;" id="saved_reward_by_total_amount"></i>
                <span id="errors_reward_by_total_amount" style="color: red;"></span>
            </div>
            <textarea name="reward_by_total_amount" class="def_textarea tiny_editor" rows="6">{{ old('reward_by_total_amount', optional($project)->reward_by_total_amount) }}</textarea>
        </div>
        <div class="ps_plan_form_item">
            <div class="form_item_tit">支援件数順リターン内容<span class="hissu_txt">必須</span><span class="disclaimer">※300文字以内で入力してください</span></div>
            <div class="spinner-wrapper">
                <div class="spinner" id="spinner_reward_by_total_quantity"></div>
                <i class="fa fa-check-circle green" aria-hidden="true" style="display: none;" id="saved_reward_by_total_quantity"></i>
                <span id="errors_reward_by_total_quantity" style="color: red;"></span>
            </div>
            <textarea name="reward_by_total_quantity" class="def_textarea tiny_editor" rows="6">{{ old('reward_by_total_quantity', optional($project)->reward_by_total_quantity) }}</textarea>
        </div>
    </div>

    <x-common.save_back_button />
</form>
