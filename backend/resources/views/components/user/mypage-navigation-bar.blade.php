<div class="prof_page_L">

    <div class="prof_img_box">
        <div class="prof_img">
            @if(isset(Auth::user()->profile))
            <img src="{{ Storage::url(Auth::user()->profile->image_url) }}">
            @else
            <img src="image/my-page.svg">
            @endif
        </div>
        <div class="prof_img_name">{{ Auth::user()->name }}</div>
    </div>
    <div class="prof_btn_box_base">
        <div class="prof_btn_box_01">
            <div class="pbb_01_01"><i class="fas fa-volume-up"></i> 応援購入<a class="cover_link"></a></div>
            <div class="pbb_01_link">お気に入りプロジェクト<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.liked_projects') }}" class="cover_link"></a>
            </div>
            <div class="pbb_01_link">購入履歴 / PSになる<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.payment_history') }}" class="cover_link"></a>
            </div>
            {{-- <div class="pbb_01_link">投稿コメント一覧<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.contribution_comments') }}" class="cover_link"></a>
            </div> --}}
            <div class="pbb_01_link">メッセージ一覧<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.message.index') }}" class="cover_link"></a>
            </div>
        </div>
        <div class="prof_btn_box_02">
            <div class="pbb_01_01"><i class="fas fa-user"></i> アカウント情報<a class="cover_link"></a></div>
            <div class="pbb_01_link">プロフィール編集<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.profile') }}" class="cover_link"></a>
            </div>
            <div class="pbb_01_link">銀行口座<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.bank_account.edit') }}" class="cover_link"></a>
            </div>
            <div class="pbb_01_link">退会について<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.withdraw') }}" class="cover_link"></a>
            </div>
        </div>
        <div class="prof_btn_box_03">
            <div class="pbb_01_01">
                <x-user.crown ranking="4" size="" />
                プロジェクト
                <a class="cover_link"></a>
            </div>
            <div class="pbb_01_link">
                マイプロジェクト管理
                <i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.my_project.project.index') }}" class="cover_link"></a>
            </div>
        </div>
    </div>

</div><!--/prof_page_L-->
