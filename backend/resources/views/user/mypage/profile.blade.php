@extends('user.layouts.base')

@section('title', 'マイページ | プロフィール')

@section('content')
    <section class="content">
        <div class="tit_L_01 E-font">
            <h2>PROFILE</h2>
        </div>
        <div class="prof_page_base inner_item">
            <x-user.mypage-navigation-bar/>
            <x-user.mypage.profile-form />
        </div>
        <div class="tit_L_01 E-font" style="margin: 50px 0 0 0;"><h2>EMAIL</h2></div>
            <div class="prof_page_base inner_item">
                <div class="prof_page_L">
                </div><!--/prof_page_L-->
                <div class="prof_page_R">
                    {{-- <div class="prof_edit_row">
                        <div class="prof_edit_01">ニュースレター購読<br><span>編集中</span></div>
                        <div class="prof_edit_editbox pee_select_hori">
                            <div class="cp_ipselect cp_normal">
                                <select name="email_01">
                                    <option value="yes">購読する</option>
                                    <option value="no">購読しない</option>
                                </select>
                            </div>
                        </div>
                        <div class="prof_edit_03">更新<a href="★" class="cover_link"></a></div>
                    </div><!--/prof_edit_row-->
                    <div class="prof_edit_row">
                        <div class="prof_edit_01">活動レポート通知<br><span>編集中</span></div>
                        <div class="prof_edit_editbox pee_select_hori">
                            <div class="cp_ipselect cp_normal">
                                <select name="email_02">
                                    <option value="yes">受け取る</option>
                                    <option value="no">受け取らない</option>
                                </select>
                            </div>
                        </div>
                        <div class="prof_edit_03">更新<a href="★" class="cover_link"></a></div>
                    </div><!--/prof_edit_row-->
                    <div class="prof_edit_row">
                        <div class="prof_edit_01">Myタグの新着通知<br><span>編集中</span></div>
                        <div class="prof_edit_editbox pee_select_hori">
                            <div class="cp_ipselect cp_normal">
                                <select name="email_03">
                                    <option value="yes">受け取る</option>
                                    <option value="no">受け取らない</option>
                                </select>
                            </div>
                        </div>
                        <div class="prof_edit_03">更新<a href="★" class="cover_link"></a></div>
                    </div><!--/prof_edit_row--> --}}
                    <div class="prof_edit_taikai_btn">
                        <a href="{{ route('user.withdraw') }}">
                            退会する場合はこちら
                        </a>
                    </div>
                </div><!--/prof_page_R-->
            </div>
    </section>
@endsection

@section('script')

@endsection
