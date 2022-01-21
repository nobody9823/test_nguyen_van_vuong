<div style="width: 100%">
    <div class="av_sns_btn dis_f_wra_alc">
        <a href="https://twitter.com/share?&text=私が応援しているプロジェクトです！応援お願いします！%0a%23fanreturn%20%23ファンリターン%0a&url={{ $invitationUrl() }}" target="_blank">
            <img class="" src="{{ asset('image/sns_01.svg') }}">
        </a>

        {{-- PC --}}
        <a class="line_link-pc" href="https://social-plugins.line.me/lineit/share?url={{ $invitationUrl() }}&text=私が応援しているプロジェクトです！応援お願いします！" target="_blank"><img src="{{ asset('image/sns_02.svg') }}"></a>

        {{-- SP --}}
        <a class="line_link-sp" href="https://line.me/R/share?text=%E7%A7%81%E3%81%8C%E5%BF%9C%E6%8F%B4%E3%81%97%E3%81%A6%E3%81%84%E3%82%8B%E3%83%97%E3%83%AD%E3%82%B8%E3%82%A7%E3%82%AF%E3%83%88%E3%81%A7%E3%81%99%EF%BC%81%E5%BF%9C%E6%8F%B4%E3%81%8A%E9%A1%98%E3%81%84%E3%81%97%E3%81%BE%E3%81%99%EF%BC%81%0d%0a{{ urlencode($invitationUrl()) }}"><img src="{{ asset('image/sns_02.svg') }}"></a>

        <div data-href="{{ $invitationUrl() }}">
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?quote=私が応援しているプロジェクトです！応援お願いします！&u={{ $invitationUrl() }}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
                <img class="" src="{{ asset('image/sns_03.svg') }}">
            </a>
        </div>
    </div>
    <div class="def_btn">
        <p id="js-copytext" style="display: none">{{ $invitationUrl() }}</p>
        招待リンクをコピーする<a class="cover_link" style="cursor: pointer" id="js-copybtn"></a>
        <p id="js-copyalert" style="display: none">コピーできました！</p>
    </div>
</div>
@if ($rankingButton === true)
<div class="m_b_4030" style="width: 100%">
    <div class="def_btn">ランキングを見る
        <a href="{{ route('user.project.supporter_ranking', ['project' => $project]) }}" class="cover_link"></a>
    </div>
</div>
@endif

@if ($project->user->id === Auth::id())
<x-common.label
    text="あなたのプロジェクトを支援したユーザー向けのプロジェクトサポーター説明ページです。"
/>
<script src="{{ asset('/js/pointer-events.js') }}"></script>
@endif

<script>
    $(function() {
      $('#js-copybtn').on('click', function(){
        // コピーする文章の取得
        let text = $('#js-copytext').text();
        // テキストエリアの作成
        let $textarea = $('<textarea></textarea>');
        // テキストエリアに文章を挿入
        $textarea.text(text);
        //　テキストエリアを挿入
        $(this).append($textarea);
        //　テキストエリアを選択
        $textarea.select();
        // コピー
        document.execCommand('copy');
        // テキストエリアの削除
        $textarea.remove();
        // アラート文の表示
        $('#js-copyalert').show().delay(2000).fadeOut(400);
      });
    });
</script>
