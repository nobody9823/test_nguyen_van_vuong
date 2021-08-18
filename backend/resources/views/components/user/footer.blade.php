<footer>
    <div class="footer_main">
        <div class="footer_main_inner">
            <div class="footer_main_01">
                <h4 class="footer_tit">プロジェクトをさがす</h4>

                @foreach($tags as $tag)
                    <p class="footer_item"><a href="{{ route('user.search', ['tag_id' => $tag->id]) }}">{{$tag->name}}</a></p>
                @endforeach

            </div>

            <div class="footer_main_02">
                <h4 class="footer_tit">プロジェクトをはじめる</h4>
                {{-- <div class="footer_item"><a href="★">プロジェクト掲載</a></div> --}}
                <div class="footer_item"><a href="{{ route('user.my_project.project.index') }}">プロジェクトを作る</a></div>
            </div>

            <div class="footer_main_03">
                <h4 class="footer_tit">fanreturnについて</h4>
                {{-- <div class="footer_item"><a href="★">fanreturnとは</a></div>
                <div class="footer_item"><a href="★">クラウドファンティングとは</a></div>
                <div class="footer_item"><a href="★">ヘルプ</a></div>
                <div class="footer_item"><a href="★">お問い合わせ</a></div> --}}
                <div class="footer_item"><a href="{{ route('user.terms_of_service') }}">利用規約</a></div>
                <div class="footer_item"><a href="{{ route('user.ps_terms_of_service') }}">プロジェクトサポーター利用規約</a></div>
                <div class="footer_item"><a href="{{ route('user.privacy_policy') }}">プライバシーポリシー</a></div>
                <div class="footer_item"><a href="{{ route('user.trade_law') }}">特定商取引法に基づく表記</a></div>
                {{-- <div class="footer_item"><a href="★">情報セキュリティ方針</a></div>
                <div class="footer_item"><a href="★">反社基本方針</a></div> --}}
                {{-- <div class="footer_sns_icon">
                    <a href="★"><img class="" src="{{ asset('image/sns_01.svg') }}"></a>
                    <a href="★"><img class="" src="{{ asset('image/sns_02.svg') }}"></a>
                    <a href="★"><img class="" src="{{ asset('image/sns_03.svg') }}"></a>
                </div> --}}
            </div>
        </div><!--/.footer_inner-->
    </div><!--/.footer_main-->

    <div class="footer_under">
        <div class="footer_under_inner">
            <div class="footer_logo">
                <img class="h_logo_css" src="{{ asset('image/logo-color.svg') }}">
            </div>
            <ul class="footer_list">
                <li><a href="{{ route('user.my_project.project.index') }}">はじめる</a></li>
                <li><a href="{{ route('user.search') }}">さがす</a></li>
                <li><a href="{{ route('user.question') }}">ファンリターンとは</a></li>

                @guest('web')
                <li>
                    <div class="menuset_03 wm_login_btn">
                        <a href="{{ route('login') }}">
                            ログイン
                        </a>
                    </div>
                </li>
                <li>
                    <div class="menuset_03 wm_signup_btn">
                        <a href="{{ route('user.pre_create') }}">
                            新規登録
                        </a>
                    </div>
                </li>
                @endguest

            </ul>
        </div><!--/.footer_inner-->
    </div><!--/.footer_under-->

</footer>