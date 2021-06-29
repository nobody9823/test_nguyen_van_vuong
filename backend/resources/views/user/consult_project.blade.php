@extends('user.layouts.base')

@section('title', 'Dashboard')

@section('content')
{{--エラーメッセージ--}}
    <div class="content">
        <div class="section">

            <form action="{{ route('user.consult_project.send') }}" method="POST" enctype="multipart/form-data" id="consultForm">
                @csrf
                <label style="color: red;">担当者名[必須]</label>
                <input type="text" name="name" required/>
                <label style="color: red;">メールアドレス[必須]</label>
                <input type="email" name="email" required/>
                <label style="color: red;">電話番号（ハイフンなし）[必須]</label>
                <input type="text" name="phone_number" required/>
                <label style="color: red;">郵便番号（ハイフンなし）[必須]</label>
                <input type="text" name="postal_code" required/>
                <label style="color: red;">都道府県[必須]</label>
                <select name="prefecture" required>
                    @foreach(\App\Helpers\PrefectureHelper::getPrefectures() as $prefecture)
                    <option value="{{ $prefecture }}">{{ $prefecture }}</option>
                    @endforeach
                </select>
                <label style="color: red;">市区町村[必須]</label>
                <input type="text" name="city" required/>
                <label style="color: red;">番地[必須]</label>
                <input type="text" name="block" required/>
                <label>建物名</label>
                <input type="text" name="building"/>
                <label>企業ホームページ</label>
                <input type="text" name="site_url"/>
                <label style="color: red;">実施したいプロジェクトのカテゴリを選択してください[必須]</label>
                <select name="category" required>
                    <option value="テストカテゴリー１">テストカテゴリー１</option>
                    <option value="テストカテゴリー２">テストカテゴリー２</option>
                    <option value="テストカテゴリー３">テストカテゴリー３</option>
                </select>
                <label style="color: red;">fanReturnにご相談いただいたきっかけを教えてください。<br/>（最も当てはまるものを選択してください。）[必須]</label>
                <select name="motive" required>
                    {{-- NOTICE この項目は今後管理画面から編集できるように要望が来そうですが、一旦そのまま項目出します --}}
                    <option value="Facebook広告/Twitter広告">Facebook広告/Twitter広告</option>
                    <option value="SNSでの友人のシェア/リツイート">SNSでの友人のシェア/リツイート</option>
                    <option value="Webメディアの記事">Webメディアの記事</option>
                    <option value="テレビ・ラジオ番組">テレビ・ラジオ番組</option>
                    <option value="テレビCM">テレビCM</option>
                    <option value="書籍/雑誌/新聞">書籍/雑誌/新聞</option>
                    <option value="友達・知人">友達・知人</option>
                    <option value="金融機関からの紹介">金融機関からの紹介</option>
                    <option value="FanReturnを実施した実行者の紹介">FanReturnを実施した実行者の紹介</option>
                    <option value="FanReturnが主催したイベント">FanReturnが主催したイベント</option>
                    <option value="FanReturnスタッフからのご連絡">FanReturnスタッフからのご連絡</option>
                    <option value="過去に問い合わせをしたことがある">過去に問い合わせをしたことがある</option>
                    <option value="過去にFanReturnを実施したことがある">過去にFanReturnを実施したことがある</option>
                    {{-- <option value="その他">その他</option> FIXME その他選択時にインプットフォームの値をname="motive"にセットされるように今後実装します--}}
                </select>
                <label>紹介の場合や過去にFanReturnの担当者とやりとりされている場合は、紹介企業名や、紹介者名、FanReturnの担当者名をご記入ください。</label>
                <input type="text" name="introducer" />
                <label style="color: red;">相談内容[必須]</label>
                <textarea name="consultation_content" required></textarea>
                <label>プロジェクトの概要が分かる画像ファイル</label>
                <input type="file" name="files[]" multiple accept=".jpg,.gif,.png,image/gif,image/jpeg,image/png"/>
                <input type="checkbox" required />
                <p style="color: red;">利用規約、及びガイドラインを確認し、自己または自己の役員および従業員が利用規約で規定する暴力団等並びに反社会的勢力等に該当しないことを表明し、保証します。[必須]</p>
                <button type="submit">確認する</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script>
    jQuery(function ($) {
        $('#consultForm').submit(function(e) {
            e.preventDefault();
            if (confirm("未実装 ここのタイミングでポップアップで確認画面を表示できるようにします")) {
                document.getElementById('consultForm').submit();
            } else {
                //cancel
                return false;
            }
        });
    });
</script>
@endsection
