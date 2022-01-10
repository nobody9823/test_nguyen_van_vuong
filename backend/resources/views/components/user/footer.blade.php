<footer>
    <div class="footer_main">
        <div class="footer_main_inner">

            <div class="footer_main_01">
                {{-- <h4 class="footer_tit">プロジェクトをさがす</h4>
                @foreach($tags as $tag)
                    <p class="footer_item"><a href="{{ route('user.search', ['tag_id' => $tag->id]) }}">{{$tag->name}}</a></p>
                @endforeach --}}
                <h4 class="footer_tit">エントリー一覧</h4>
                <p class="footer_item"><a href="{{ config('app.wp_baseURL').'/category/category1' }}">音楽制作</a></p>
                <p class="footer_item"><a href="{{ config('app.wp_baseURL').'/category/category2' }}">映像制作</a></p>
                <p class="footer_item"><a href="{{ config('app.wp_baseURL').'/category/category3' }}">番組制作</a></p>
                <p class="footer_item"><a href="{{ config('app.wp_baseURL').'/category/category4' }}">メディア出演</a></p>
                <p class="footer_item"><a href="{{ config('app.wp_baseURL').'/category/category5' }}">イベント制作/出演</a></p>
                <p class="footer_item"><a href="{{ config('app.wp_baseURL').'/category/category6' }}">企業広告モデル出演</a></p>
                <p class="footer_item"><a href="{{ config('app.wp_baseURL').'/category/category7' }}">企業コラボ</a></p>
                <p class="footer_item"><a href="{{ config('app.wp_baseURL').'/category/category8' }}">インフルエンサーコラボ</a></p>
                <p class="footer_item"><a href="{{ config('app.wp_baseURL').'/category/category9' }}">グッズ制作</a></p>
                <p class="footer_item"><a href="{{ config('app.wp_baseURL').'/category/category10' }}">その他</a></p>
            </div>

            <div class="footer_main_02">
                <h4 class="footer_tit">プロジェクト一覧</h4>
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
        </div><!--/.footer_inner-->
    </div><!--/.footer_main-->

    <div class="footer_under">
        <div class="footer_under_inner">
            <div class="footer_logo">
                <img class="h_logo_css" src="{{ asset('image/logo-color.svg') }}">
            </div>
            <ul class="footer_list">
                <li><a class="footer_list_items" href="{{ config('app.wp_baseURL').'/プロジェクト一覧' }}">エントリー一覧</a></li>
                <li><a class="footer_list_items" href="{{ route('user.index') }}">プロジェクト一覧</a></li>
                <li><a class="footer_list_items" href="{{ route('user.question') }}">ファンリターンとは</a></li>

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
