@extends('user.layouts.base')

@section('title', 'お問い合わせ')

@section('content')

{{-- <div class="content">
    <div class="section">
        <div class="fixedcontainer mypage_contents sign-in_box"> --}}
            {{-- <h2><i class="fas fa-envelope"></i>お問い合わせ</h2> --}}
    <section id="" class="inquiry_attention_section">
        <div class="inquiry_section_inner inner_item">
            <div class="tit_L_01 E-font"><h2>CONTACT</h2><div class="sub_tit_L">お問い合わせ</div></div>
            <div class="inquiry_attention_box">
                <p class="inquiry_attention">お問い合わせの前に必ずご確認ください</p>
                <p class="inquiry_text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
            </div>
            <div class="inquiry_transition_box">
                <p class="inquiry_attention inquiry_attention_2">ご不明な点がありましたら、ヘルプページをご覧ください</p>
                <p class="inquiry_anchor_wrapper"><a class='inquiry_anchor' href="">サポーター向けよくある質問</a></p>
                <p class="inquiry_anchor_wrapper"><a class='inquiry_anchor' href="">プロジェクト実行者向けよくある質問</a></p>
                <p class="inquiry_anchor_wrapper"><a class='inquiry_anchor' href="">ヘルプページ</a></p>
            </div>
        </div>
    </section>

    <section class="inquiry_form_section">
        <div class="inquiry_form_section_inner inner_item">
            <p class="inquiry_form_text">上記の内容を確認の上で、不明点や問題が解決されない場合はカスタマーサポートにお問い合わせください。</p>
            <form class="inquiry_form_group" action="{{ route('user.inquiry.send') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="inquiry_form">
                    <div class="form_item_row">
                        <div class="form_item_tit">氏名<span class="hissu_txt">必須</span></div>
                        <input type="text" name="name" class="p-postal-code def_input_100p" value="{{ old('name') }}" placeholder="インフルエンサー 花子" required>
                    </div>
                </div>
                
                <div class="inquiry_form">
                    <div class="form_item_row">
                        <div class="form_item_tit">メールアドレス<span class="hissu_txt">必須</span></div>
                        <input type="email" name="email" class="p-postal-code def_input_100p" id="email" value="{{ old('email') }}" placeholder="○○○○○○○○○○○○@○○○○○○.com" required>
                    </div>
                </div>
    
                <div class="inquiry_form">
                    <div class="form_item_row">
                        <div class="form_item_tit">お問い合わせ種類<span class="nini_txt">任意</span></div>
                        <div class="cp_ipselect cp_normal" style="width: 100%">
                            <select name="inquiry_category" class="p-region">
                                <option selected>選択してください</option>
                                @foreach($inquiry_categories as $inquiry_category)
                                <option value="{{$inquiry_category}}" {{ old('inquiry_category')== $inquiry_category ? 'selected' : '' }}>
                                    {{$inquiry_category}}
                                </option>
                                @endforeach                        
                            </select>
                        </div>
                    </div>
                </div>
    
                <div class="inquiry_form">
                    <div class="form_item_row">
                        <div class="form_item_tit">デバイス種類<span class="nini_txt">任意</span></div>
                        <div class="cp_ipselect cp_normal" style="width: 100%">
                            <select name="device_type" class="p-region">
                                <option selected>選択してください</option>
                                <option value='pc' {{ old('device_type')== 'pc' ? 'selected' : '' }}>PC</option>
                                <option value='smartphone' {{ old('device_type')== 'smartphone' ? 'selected' : '' }}>スマートフォン(WEB)</option>
                                <option value='tablet' {{ old('device_type')== 'tablet' ? 'selected' : '' }}>タブレット</option>
                                <option value='others' {{ old('device_type')== 'others' ? 'selected' : '' }}>その他</option>
                            </select>
                        </div>
                    </div>
                </div>
    
                <div class="inquiry_form">
                    <div class="form_item_row">
                        <div class="form_item_tit">プロジェクトページ名<span class="nini_txt">任意</span></div>
                        <input type="text" name="project_page_name" class="p-postal-code def_input_100p" value="{{ old('project_page_name') }}">
                    </div>
                </div>

                <div class="inquiry_form">
                    <div class="form_item_row">
                        <div class="form_item_tit">お問い合わせ件名<span class="hissu_txt">必須</span></div>
                        <input type="text" name="title" class="p-postal-code def_input_100p" value="{{ old('title') }}" required>
                    </div>
                </div>

                <div class="inquiry_form">
                    <div class="form_item_row">
                        <div class="form_item_tit">お問い合わせ内容<span class="hissu_txt">必須</span>
                            <span class="disclaimer">※300文字以内で入力してください</span>
                        </div>
                        <textarea name="content" class="def_textarea" id="content" required>{{ old('content') }}</textarea>
                    </div>
                </div>
                {{-- <div class="inquiry_attention_border"></div> --}}
                <div class="inquiry_notice_box">
                    <p>・内容により回答をおまたせする場合や、回答しかねる場合がございます。</p>
                    <p>・弊社からの回答は、弊社の許可なく、記事の全文または一部の無断転載および再配布はご遠慮いただいております。</p>
                </div>



                {{-- <div class="inquiry_attention_border"></div> --}}
    
                {{-- <div class="form">
                    <label for="image-upload" class="control-label">添付ファイル</label>
    
                    <div class="user_profile_img">
                        <label class="btn-image-upload" style="cursor: pointer;">
                            <i class="far fa-image"></i>
                            <input type="file" name="images[]" style="display: none;" class="image_file" id="numberOfFiles" value="{{ old('image') }}" multiple="multiple" onchange="uploadImage(this);">
                            <p>画像をアップロードする<br>縦横比200px*200px以上の画像推奨</p>
                        </label>
                    </div>
                </div>
    
                <div id="preview"></div> --}}
                {{-- <button type="submit" id="send" class="my-page_btn">問い合わせる</button> --}}
                <div style='text-align:center'>
                    <input required type="checkbox" id="confirm" class="ac_list_checks" value="confirm">
                    <label for="confirm" class="inquiry_confirm_text checkbox-fan">上記の前提事項、及び<a href="#">利用規約</a>の個人情報保護方針を確認しました</label>
        
                    <button type="submit" id="send" class="inquiry_button">問い合わせる</button>
                </div>
            </form>
        </div>

    </section>
    <x-user.footer-over-base />

        {{-- </div>
    </div>
</div> --}}
@endsection

<script type="text/javascript" src="{{ asset('js/uploaded-images-preview.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/required_check.js') }}"></script>
<script>
    function hello(el){
        // console.log(el.checked);
    }
    window.addEventListener('DOMContentLoaded', () => {
        required_check('.inquiry_button');
    });
</script>