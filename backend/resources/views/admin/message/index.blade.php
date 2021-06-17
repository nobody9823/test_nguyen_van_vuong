@extends('admin.layouts.base')
@section('title', 'メッセージ一覧')
@section('content')
<div class="content">
    <div class="section">
        <div class="container" style="max-width: 100%">
            <div class="row mb-5">

                <div class="col-sm-12">
                    <div class="ml-2">
                        <div class="justify-content-center mt-3 p-3" style="background-color: #eee">
                            <div class="col-sm-12 p-2 bg-light d-flex align-items-center justify-content-between">
                                <div class="text-left">
                                    <form name='form_to_keep_request' action="">
                                        <x-common.add_hidden_query />
                                        メッセージ一覧(新着順) 全{{count($chating_messages) + count($not_chating_messages)}}件<br>
                                        絞り込み状況 :
                                        @if (Request::query())
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('admin.message.index') }}">検索条件をリセット</a>
                                        @endif
                                        @if(Request::get('message_word'))
                                        <div class="d-flex align-items-center">
                                            検索ワード :{{ Request::get('message_word') }}
                                        </div>
                                        @endif
                                    </form>

                                </div>
                                <form class="text-right" action={{route('admin.message.index')}} method="get">

                                    <a class="btn btn-info mr-2" href={{route('admin.user.index')}}>ユーザー一覧</a>
                                    <a class="btn btn-info mr-2" href={{route('admin.company.index')}}>企業一覧</a>
                                    {{-- ここ重複するためmessage_wordはhidden含めない --}}
                                    @if (Request::get('user'))
                                    <input type="hidden" name='user' value={{ Request::get('user') }}>
                                    @endif
                                    @if (Request::get('company'))
                                    <input type="hidden" name='company' value={{ Request::get('company') }}>
                                    @endif
                                    @if (Request::get('job_offer'))
                                    <input type="hidden" name='job_offer' value={{ Request::get('job_offer') }}>
                                    @endif
                                    {{-- ここ重複するためmessage_wordはhidden含めない --}}
                                    <input name="message_word" type="text" placeholder="未実装" class="my_search_input"
                                        style="line-height: 2.0;" value={{Request::get('message_word')}}>
                                    <button type="submit" class="btn btn-info">検索</button>

                                </form>
                            </div>
                            <div class="row mt-3">
                                @if ($chating_messages->isEmpty() && $not_chating_messages->isEmpty())
                                <div class=" col-sm-12 align-self-center">
                                    メッセージ履歴がありません。
                                </div>
                                @else

                                {{-- 左側メッセージ一覧部分 --}}
                                <div class="col-sm-4 chat_group_list" style="height:100vh; overflow-y:scroll;">

                                    {{-- チャット中プラン --}}
                                    @if ($chating_messages->isNotEmpty())
                                    <p style='background-color:rgb(182, 182, 182);margin:10px 0px 0 0;'>やりとり中支援プラン</p>
                                    @endif
                                    @foreach ($chating_messages as $message)
                                    <x-common.message.a_message_of_index :message="$message" guard='admin'
                                        :selectedMessage="isset($selected_message)?$selected_message:null" />
                                    @endforeach
                                    {{-- チャット中プラン --}}

                                    {{-- 未チャットプラン --}}
                                    @if ($not_chating_messages->isNotEmpty())
                                    <p style='background-color:rgb(182, 182, 182);margin:10px 0px 0 0;'>やりとりしていない支援プラン
                                    </p>
                                    @endif
                                    @foreach ($not_chating_messages as $message)
                                    <x-common.message.a_message_of_index :message="$message" guard='admin'
                                        :selectedMessage="isset($selected_message)?$selected_message:null" />
                                    @endforeach
                                    {{-- 未チャットプラン --}}

                                    <div class="row justify-content-center mb-5" style="margin-top: 5px;">
                                        <a class="btn btn-info" style="display: none" id="more_btn">もっと見る</a>
                                        <a class="btn btn-info" style="display: none" id="closed_btn">閉じる</a>
                                    </div>
                                </div>
                                {{-- 左側メッセージ一覧部分 --}}

                                {{-- 選択によって変わるメッセージ部分 --}}
                                <div class="col-sm-8">
                                    @if(isset($selected_message))
                                    <x-common.message.message_viewer :selectedMessage="$selected_message"
                                        guard="admin" />
                                    @else
                                    <div class="bg-light border border-secondary mb-3 p-2" style='min-height:100vh'>
                                        メッセージを選択してください
                                    </div>
                                    @endif
                                </div>
                                {{-- 選択によって変わるメッセージ部分 --}}

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script type="text/javascript">
    $(function() {
        // メッセージグループの数を取得
        var $chat_group_length = $('.chat_group').length;

        // メッセージグループを8コまで取得
        var $default_num = 8;

        // もっと見るボタンを押すとさらに8コ表示
        var $add_num = 8;

        // 現在のメッセージグループの表示数
        var $current_num = 0;

        // $current_numに初期値を代入
        $current_num = $default_num;

        $("document").ready(function() {

            // 取得したメッセージグループ数が$current_numより多い時
            if ($current_num < $chat_group_length) {
                // メッセージグループを8コまで表示してそれ以外はhideしておく
                $('.chat_group').each(function(index, element) {
                    if (index >= $default_num) {
                        $(this).hide();
                    }
                })

                // もっと見るボタンは表示して、閉じるボタンはhideする
                $("#more_btn").show();
                $("#closed_btn").hide();
                // 取得したメッセージグループ数が$current_numより少ない時
            } else if ($current_num >= $chat_group_length) {
                // もっと見るボタンと閉じるボタンをhideする
                $("#more_btn").hide();
                $("#closed_btn").hide();
            }

            // もっと見るボタンを押した時
            $("#more_btn").click(function() {
                // $current_num変数を更新
                $current_num += $add_num;
                // 現在表示しているメッセージグループに12コ追加で表示
                $(".chat_group_list").find(".chat_group:lt("+ $current_num +")").slideDown();

                // $current_numより取得したメッセージグループが少ない場合
                if ($current_num >= $chat_group_length) {
                    // $current_numをデフォルト値を代入
                    $current_num = $default_num;
                    // インデックス用の値をセット
                    var $index_num = $current_num - 1;
                    // もっと見るボタンをhideして、閉じるボタンを表示
                    $("#more_btn").hide();
                    $("#closed_btn").show();

                    // 閉じるボタンを押した時
                    $("#closed_btn").click(function() {
                        // インデックスが$index_numより大きい要素は非表示
                        $(".chat_group_list").find(".chat_group:gt("+ $index_num +")").slideUp();
                        // 閉じるボタンはhide、もっと見るボタンは表示
                        $("#closed_btn").hide();
                        $("#more_btn").show();
                    })
                }
            })
        })
    })

    $(function(){
    $(".btn-dell").click(function(){
        if(confirm("本当に削除しますか？")){
            //そのままsubmit（削除）
        }else{
            //cancel
            return false;
        }
    });
});

    let target = document.getElementById('scroll-inner');
    target.scrollIntoView(false);

</script>
@endsection
