<footer>
    <div class="footer_main">
        <div class="footer_main_inner">

            <div class="footer_main_02">
                <h4 class="footer_tit">プロジェクト一覧</h4>
                {{-- <div class="footer_item"><a href="★">プロジェクト掲載</a></div> --}}
                <div class="footer_item"><a href="{{ route('user.my_project.project.index') }}">プロジェクトを作る</a>
                </div>
            </div>

            <div class="footer_main_03">
                <h4 class="footer_tit">fanreturnについて</h4>
                {{-- <div class="footer_item"><a href="★">fanreturnとは</a></div>
                <div class="footer_item"><a href="★">クラウドファンティングとは</a></div>
                <div class="footer_item"><a href="★">ヘルプ</a></div>
                <div class="footer_item"><a href="★">お問い合わせ</a></div> --}}
                <div class="footer_item"><a href="{{ route('user.terms_of_service') }}">利用規約</a></div>
                <div class="footer_item"><a href="{{ route('user.ps_terms_of_service') }}">プロジェクトサポーター利用規約</a>
                </div>
                <div class="footer_item"><a href="{{ route('user.privacy_policy') }}">プライバシーポリシー</a></div>
                <div class="footer_item"><a href="{{ route('user.trade_law') }}">特定商取引法に基づく表記</a></div>
                <div class="footer_item"><a href="{{ route('user.inquiry.create') }}">お問い合わせ</a></div>
                <div class="footer_item"><a href="https://ichj.co.jp/">運営会社</a></div>
                {{-- <div class="footer_item"><a href="★">情報セキュリティ方針</a></div>
                <div class="footer_item"><a href="★">反社基本方針</a></div> --}}
                {{-- <div class="footer_sns_icon">
                    <a href="★"><img class="" src="{{ asset('image/sns_01.svg') }}"></a>
                    <a href="★"><img class="" src="{{ asset('image/sns_02.svg') }}"></a>
                    <a href="★"><img class="" src="{{ asset('image/sns_03.svg') }}"></a>
                </div> --}}
            </div>
        </div>
        <!--/.footer_inner-->
    </div>
    <!--/.footer_main-->

    <div class="footer_under">
        <div class="footer_under_inner">
            <div class="footer_logo">
                <img class="h_logo_css" src="{{ asset('image/logo-color.svg') }}">
            </div>
            <ul class="footer_list">
                <li><a class="footer_list_items" href="{{ route('user.question') }}">ファンリターンとは</a></li>
                <li><a class="footer_list_items" href="{{ route('user.index') }}">プロジェクト一覧</a></li>

                @guest('web')
                    <li>
                        <div class="menuset_03 wm_login_btn">
                            <a href="{{ route('login') }}">
                                クラファンに<br />ログイン
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="menuset_03 wm_signup_btn">
                            <a href="{{ route('user.pre_create') }}">
                                クラファンに<br />新規会員登録
                            </a>
                        </div>
                    </li>
                @endguest

            </ul>
        </div>
        <!--/.footer_inner-->
    </div>
    <!--/.footer_under-->

    <!-- フッター固定 -->
    @guest('web')
        <div id="sp_footer_float">
            <div class="sp_footer_float_close"><a href="javascript:void(0)" style=" color: #fff;"><i aria-hidden="true" class="fa fa-times"></i></a></div>
                <div class="sff_01">
                        <a href="{{ route('login') }}">
                        <div class="sff_01_01 sff_flex_center" style=" color: #fff;"><img src="{{ asset('image/login_white_24dp.svg') }}">クラファンにログイン</div>
                        </a>
                </div>
                <div class="sff_02">|</div>
                <div class="sff_03">
                    <a href="{{ route('user.pre_create') }}" class="sff_03_01">
                    <div class="sff_flex_center" style=" color: #fff;"><img src="{{ asset('image/person_add_white_24dp.svg') }}">クラファンに新規会員登録</div>
                    </a>
                </div>
        </div>
    @endguest

    @auth('web')
    <div id="sp_footer_float">
        <div class="sp_footer_float_close"><a href="javascript:void(0)" style=" color: #fff;"><i aria-hidden="true" class="fa fa-times"></i></a></div>
            <div class="sff_01">
                    <a href="{{ route('user.profile') }}">
                    <div class="sff_01_01 sff_flex_center" style=" color: #fff;"><img src="{{ asset('image/person_white_24dp.svg') }}">プロフィール</div>
                    </a>
            </div>
            <div class="sff_02">|</div>
            <div class="sff_03">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="sff_flex_center sff_03_logout_form"><img src="{{ asset('image/logout_white_24dp.svg') }}">クラファンからログアウト</button>
                </form>
            </div>
    </div>
    @endauth
</footer>
