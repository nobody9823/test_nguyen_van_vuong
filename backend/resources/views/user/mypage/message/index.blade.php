@extends('user.layouts.base')

@section('title', 'ダイレクトメッセージ一覧')

@section('css')
<style type="text/css">
    div#hovering-grey:hover {
        background-color: #F7FDFF;
    }
</style>
@endsection

@section('content')
<section id="supported-projects" class="section_base">
    <div class="tit_L_01 E-font">
        <h2>DIRECT MESSAGE</h2>
        <div class="sub_tit_L">ダイレクトメッセージ一覧</div>
    </div>
    <div class="prof_page_base inner_item">
        <div class="prof_page_L">
            <x-user.mypage-navigation-bar/>
        </div>
        <div class="prof_page_R">
            {{-- <div class="fixedcontainer mypage_contents">

                <div class="message_container">
                    <div class="message_container__body">
                        <div class="message_container__body-menu">
                            <p class="message_container_menu is-pc">
                                ダイレクトメッセージ一覧
                                @if (Request::get('message_word'))
                                検索ワード:{{ Request::get("message_word") }}
                                @endif
                            </p>

                    <button class="message_container_menu is-sp">
                        ダイレクトメッセージ一覧を見る
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
            </div> --}}

            <div class="message_body">
                <div class="chat_group_list">
                    {{-- 検索結果踏まえて送信する用フォーム --}}
                    <form name='form_to_keep_request' action="" method="GET">
                        <x-common.add_hidden_query />
                        @if (Request::get('message_word'))
                        <input name='message_word' type="hidden" value={{ Request::get('message_word') }}>
                        @endif
                    </form>

                    {{-- 検索結果踏まえて送信する用フォーム --}}

                    <div class="chat_wrapper">
                        <div>
                            {{-- チャット中プロジェクト --}}
                            <a href="{{ route('user.admin_message_content.index') }}" class="chat_group_title admin_chat_group_title">
                                運営事務局とのDM
                                @if($admin_message->admin_message_contents_count !== 0)
                                <span class="chat_unread_count">
                                    {{ $admin_message->admin_message_contents_count }}
                                </span>
                                @endif
                            </a>
                            {{-- チャット中プロジェクト --}}
                        </div>
                        <div class="accordion js-accordion">
                            {{-- チャット中プロジェクト --}}
                            <div class="accordion__item js-accordion-trigger">
                                @if ($chating_myprojects->isNotEmpty())
                                <p class="accordion__title accordion__arrow chat_group_title chat_group_title_to_supporters">
                                    自分が立ち上げたプロジェクトの購入者とのDM
                                    @if($chating_myprojects->sum('message_contents_count') !== 0)
                                    <span class="chat_unread_count">
                                        {{ $chating_myprojects->sum('message_contents_count') }}
                                    </span>
                                    @endif
                                </p>
                                @endif
                                <div class="accordion__content">
                                    @foreach ($chating_myprojects as $project)
                                    <x-common.message.a_chat_project_of_index :project="$project" guard='executor'/>
                                    @endforeach
                                </div>
                            </div>
                            {{-- チャット中プロジェクト --}}
                        </div>
                        <div class="accordion js-accordion">
                            {{-- チャット中プロジェクト --}}
                            <div class="accordion__item js-accordion-trigger">
                                @if ($chating_messages->isNotEmpty())
                                <p class="accordion__title accordion__arrow chat_group_title chat_group_title_to_influencer">
                                    自分が支援したプロジェクトのDM
                                    @if($chating_messages->sum('message_contents_count') !== 0)
                                    <span class="chat_unread_count">
                                        {{ $chating_messages->sum('message_contents_count') }}
                                    </span>
                                    @endif
                                </p>
                                @endif
                                <div class="accordion__content">
                                    @foreach ($chating_messages as $message)
                                    <x-common.message.a_message_of_index :message="$message" guard='supporter'
                                        :selectedMessage="isset($selected_message)?$selected_message:null" />
                                    @endforeach
                                </div>
                            </div>
                            {{-- チャット中プロジェクト --}}
                        </div>
                    </div>

            </div>

            <div class="chat_group_list__background" onclick="clickBackground(this)"></div>

            <div class="message__text" style="margin-top: 10px;">
                {{-- <button class="message_container_menu is-sp" style="margin-bottom: 5px"
                    onclick="displayMessageSidebar(this)">
                    一覧表示
                </button> --}}

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
</section>
@endsection

@section('script')
<script src="{{ asset('js/accordion.js') }}"></script>
<script>
    // function displayMessageSidebar(target) {
    //     console.log(target);
    //     if (target.classList.contains('open')) {
    //         target.classList.remove('active');
    //         target.replaceChild(document.createTextNode("ダイレクトメッセージ一覧"),target.firstChild);
    //         document.getElementsByClassName('chat_group_list').classList.remove("open");
    //         document.getElementsByClassName('chat_group_list__background').classList.remove("open");
    //     } else {
    //         target.classList.add('active');
    //         target.replaceChild(document.createTextNode("CLOSE"),target.firstChild);
    //         document.getElementsByClassName('chat_group_list')[0].classList.add("open");
    //         document.getElementsByClassName('chat_group_list__background')[0].classList.add("open");
    //     }
    // }

    function clickBackground(target){
        // .menu-backgroundに.openがあるかどうか
        if (target.classList.contains('open')) {
            // .openがあるときの処理
            target.classList.remove("open");
            message_container_menu = document.getElementsByClassName('message_container_menu')[0];
            chat_group_list = document.getElementsByClassName('chat_group_list')[0];
            message_container_menu.classList.remove('active');
            message_container_menu.replaceChild(document.createTextNode("ダイレクトメッセージ一覧"),message_container_menu.firstChild);
            chat_group_list.classList.remove("open");
        }
    }
</script>
@endsection
