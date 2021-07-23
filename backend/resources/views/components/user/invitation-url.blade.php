<div class="m_b_1510">
    <div class="av_sns_btn dis_f_wra_alc">
        <a href="https://twitter.com/share?&url={{ $invitationUrl() }}">
            <img class="" src="{{ asset('image/sns_01.svg') }}">
        </a>
        <div class="line-it-button" data-lang="ja" data-type="share-c" data-ver="3" data-url="{{ $invitationUrl() }}" data-color="default" data-size="large" data-count="false" style="display: none;"></div>
        <div data-href="{{ $invitationUrl() }}">
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $invitationUrl() }}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
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
