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
            <div class="pbb_01_link">応援購入したプロジェクト<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.purchased_projects') }}" class="cover_link"></a>
            </div>
            <div class="pbb_01_link">お気に入りプロジェクト<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.liked_projects') }}" class="cover_link"></a>
            </div>
            <div class="pbb_01_link">購入履歴<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.payment_history') }}" class="cover_link"></a>
            </div>
            {{-- <div class="pbb_01_link">投稿コメント一覧<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.contribution_comments') }}" class="cover_link"></a>
            </div> --}}
            <div class="pbb_01_link">ダイレクトメッセージ一覧<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.message.index') }}" class="cover_link"></a>
            </div>
        </div>
        <div class="prof_btn_box_02">
            <div class="pbb_01_01"><i class="fas fa-user"></i> アカウント情報<a class="cover_link"></a></div>
            <div class="pbb_01_link">プロフィール編集<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.profile') }}" class="cover_link"></a>
            </div>
            <div class="pbb_01_link">退会について<i class="fas fa-chevron-right"></i>
                <a href="{{ route('user.withdraw') }}" class="cover_link"></a>
            </div>
        </div>
        <div class="prof_btn_box_03">
            <div class="pbb_01_01">
                <svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; width: 17px; " xml:space="preserve">
                <path id="" style="fill:#00AEBD;" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                    c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                    c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"></path>
                </svg>
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
