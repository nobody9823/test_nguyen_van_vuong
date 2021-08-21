@extends('user.layouts.base')

@section('title', 'メッセージ一覧')

@section('content')
<div class="content">
    <div class="section">

        <x-user.mypage-navigation-bar />

        <div class="fixedcontainer mypage_contents">
            <h2><i class="fas fa-lock"></i>メッセージ一覧</h2>

            <div class="message_container">
                <div class="message_container__body">
                    <div class="message_container__body-menu">
                        <p class="message_container_menu is-pc">
                            メッセージ一覧
                            @if (Request::get('message_word'))
                            検索ワード:{{ Request::get("message_word") }}
                            @endif
                        </p>

                <button class="message_container_menu is-sp">
                    メッセージ一覧を見る
                    @if (Request::get('message_word'))
                    検索ワード:{{ Request::get("message_word") }}
                    @endif
                </button>
            </div>

            <form class="message_form__body" action='' method="get">
                @csrf
                <input name="message_word" type="text" placeholder="未実装" class="my_search_input"
                    style="line-height: 2.0;" value={{Request::get('message_word')}}>
                <button type="submit" class="btn btn-info">検索</button>
            </form>
        </div>

        <div class="message_body">
            <div class="chat_group_list">
                {{-- 検索結果踏まえて送信する用フォーム --}}
                <form name='form_to_keep_request' action="">
                    <x-common.add_hidden_query />
                    @if (Request::get('message_word'))
                    <input name='message_word' type="hidden" value={{ Request::get('message_word') }}>
                    @endif
                </form>

                {{-- 検索結果踏まえて送信する用フォーム --}}

                {{-- チャット中リターン --}}
                @if ($chating_messages->isNotEmpty())
                <p style='background-color:#ddd;margin:10px 0px 0 0;'>やりとり中支援リターン</p>
                @endif
                @foreach ($chating_messages as $message)
                <x-common.message.a_message_of_index :message="$message" guard='supporter'
                    :selectedMessage="isset($selected_message)?$selected_message:null" />
                @endforeach
                {{-- チャット中リターン --}}

                {{-- 未チャットリターン --}}
                @if ($not_chating_messages->isNotEmpty())
                <p style='background-color:#ddd;margin:10px 0px 0 0;'>やりとりしていない支援リターン</p>
                @endif
                @foreach ($not_chating_messages as $message)
                <x-common.message.a_message_of_index :message="$message" guard='supporter'
                    :selectedMessage="isset($selected_message)?$selected_message:null" />
                @endforeach
                {{-- 未チャットリターン --}}

            </div>

            <div class="chat_group_list__background" onclick="clickBackground(this)"></div>

            <div class="message__text">
                <button class="message_container_menu is-sp" style="margin-bottom: 5px"
                    onclick="displayMessageSidebar(this)">
                    一覧表示
                </button>

                @if(isset($selected_message))
                <x-common.message.message_viewer :selectedMessage="$selected_message" guard="supporter" />
                @else
                <div class="" style='min-height:800px; padding: 1rem; background: #FFF;'>
                    メッセージを選択してください。
                </div>
                @endif
            </div>
        </div>
    </div>



</div>
</div>
</div>
@endsection

<script>
    function displayMessageSidebar(target) {
        console.log(target);
        if (target.classList.contains('open')) {
            target.classList.remove('active');
            target.replaceChild(document.createTextNode("メッセージ一覧"),target.firstChild);
            document.getElementsByClassName('chat_group_list').classList.remove("open");
            document.getElementsByClassName('chat_group_list__background').classList.remove("open");
        } else {
            target.classList.add('active');
            target.replaceChild(document.createTextNode("CLOSE"),target.firstChild);
            document.getElementsByClassName('chat_group_list')[0].classList.add("open");
            document.getElementsByClassName('chat_group_list__background')[0].classList.add("open");
        }
    }

    function clickBackground(target){
        // .menu-backgroundに.openがあるかどうか
        if (target.classList.contains('open')) {
            // .openがあるときの処理
            target.classList.remove("open");
            message_container_menu = document.getElementsByClassName('message_container_menu')[0];
            chat_group_list = document.getElementsByClassName('chat_group_list')[0];
            message_container_menu.classList.remove('active');
            message_container_menu.replaceChild(document.createTextNode("メッセージ一覧"),message_container_menu.firstChild);
            chat_group_list.classList.remove("open");
        }
    }
</script>

<style type="text/css">
    div#hovering-grey:hover {
        background-color: grey;
    }
</style>
