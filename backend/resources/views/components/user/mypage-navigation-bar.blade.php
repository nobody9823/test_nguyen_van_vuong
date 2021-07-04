<div class="prof_page_L">

    <div class="prof_img_box">
        @if(isset(Auth::user()->profile))
        <img class="prof_img" src="{{ Storage::url(Auth::user()->profile->image_url) }}">
        @else
        <img class="prof_img" src="image/my-page.svg">
        @endif
        <div class="prof_img_name">{{ Auth::user()->name }}</div>
    </div>
    <div class="prof_btn_box_base">
        <div class="prof_btn_box_01">
            <div class="pbb_01_01"><i class="fas fa-volume-up"></i> 応援購入<a href="#" class="cover_link"></a></div>
            <div class="pbb_01_link">応援購入したプロジェクト<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.purchased_projects') }}" class="cover_link"></a>
            </div>
            <div class="pbb_01_link">お気に入りプロジェクト<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.payment_history') }}" class="cover_link"></a>
            </div>
            <div class="pbb_01_link">購入履歴<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.liked_projects') }}" class="cover_link"></a>
            </div>
            <div class="pbb_01_link">投稿コメント一覧<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.contribution_comments') }}" class="cover_link"></a>
            </div>
            {{-- NOTICE 現状メッセージ機能の実装間に合わなそうなので一旦コメントアウトいたします --}}
            {{-- <p><a href="{{ route('user.message.index') }}">メッセージ一覧</a></p> --}}
        </div>
        <div class="prof_btn_box_02">
            <div class="pbb_01_01"><i class="fas fa-user"></i> アカウント情報<a href="#" class="cover_link"></a></div>
            <div class="pbb_01_link">プロフィール編集<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.profile') }}" class="cover_link"></a>
            </div>
            <div class="pbb_01_link">退会について<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.withdraw') }}" class="cover_link"></a>
            </div>
        </div>
    </div>

</div><!--/prof_page_L-->
