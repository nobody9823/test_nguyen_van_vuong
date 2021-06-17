{{--
    ファイルダウンロードボタン
    利用例
    <x-common.file_download_button :guard="$guard"　:messageContent="$messageContent"/>
--}}

<a id="btn-square"
    href={{ route("$guard.message_content.file_download",['message_content' => $messageContent]) }}>{{ $messageContent->file_original_name }}</a>
<style>
    #btn-square {
        display: inline-block;
        font-size: 8pt;
        /* 文字サイズ */
        text-align: center;
        /* 文字位置   */
        cursor: pointer;
        /* カーソル   */
        padding: 8px 8px;
        /* 余白       */
        background: #000066;
        /* 背景色     */
        color: #ffffff;
        /* 文字色     */
        line-height: 1em;
        /* 1行の高さ  */
        opacity: 1;
        /* 透明度     */
        transition: .3s;
        /* なめらか変化 */
        box-shadow: 2px 2px 3px #666666;
        /* 影の設定 */
    }

    #btn-square:hover {
        box-shadow: none;
        /* カーソル時の影消去 */
        opacity: 0.8;
        /* カーソル時透明度 */
    }
</style>
