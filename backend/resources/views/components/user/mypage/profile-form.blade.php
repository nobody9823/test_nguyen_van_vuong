<div class="prof_page_R">
@if(Request::get('input_type') === 'name')
    <form action="{{ route('user.update_profile', ['user' => Auth::user()]) }}" method="POST" name="nameForm">
        @method('PATCH')
        @csrf
        <div class="prof_edit_row">
            <div class="prof_edit_01">ユーザー名<br><span>編集中</span></div>
            <div class="prof_edit_editbox">
                <input name="name" type="text" placeholder="UserId" value="{{ old('name', Auth::user()->name) }}"/>
            </div>
            <div class="prof_edit_03">
                <a href="javascript:document.nameForm.submit()">更新</a>
            </div>
        </div>
    </form>
@elseif(Request::get('input_type') === 'image_url')
    <form action="{{ route('user.update_profile', ['user' => Auth::user()]) }}" method="POST" name="imageForm" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="prof_edit_row">
            <div class="prof_edit_01">プロフィール写真<br><span>編集中</span></div>
            <div class="prof_edit_editbox">
                <input type="file" id="files_input" name="image_url" accept=".png, .jpg, .jpeg, .gif"><br><span class="prof_edit_editbox_desc">ファイルサイズは1MB以下<br>ファイル形式は jpeg、gif、png 形式のみ可</span>
            </div>
            <div class="prof_edit_03">
                <a href="javascript:document.imageForm.submit()">更新</a>
            </div>
        </div>
    </form>
@elseif(Request::get('input_type') === 'email')
    <form action="{{ route('user.update_profile', ['user' => Auth::user()]) }}" method="POST" name="mailForm">
        @method('PATCH')
        @csrf
        <div class="prof_edit_row">
            <div class="prof_edit_01">メールアドレス<br><span>編集中</span></div>
            <div class="prof_edit_editbox">
                <div class="pee_tit pee_tit_first">現在のメールアドレス</div>
                <div class="pee_now">{{ Auth::user()->email }}</div>

                <div class="pee_tit">新しいメールアドレス<span class="prof_edit_editbox_desc">　半角英数字のみ</span></div>
                <input name="email" type="email"/>

                <div class="pee_tit">新しいメールアドレス（確認用）
                    {{-- <span class="prof_edit_editbox_desc">　コピー＆ペースト不可</span> --}}
                </div>
                <input name="email_confirmation" type="email"/>
            </div>
            <div class="prof_edit_03">
                <a href="javascript:document.mailForm.submit()">更新</a>
            </div>
        </div>
    </form>
@elseif(Request::get('input_type') === 'password')
    <form action="{{ route('user.update_profile', ['user' => Auth::user()]) }}" method="POST" name="passwordForm">
        @method('PATCH')
        @csrf
        <div class="prof_edit_row">
            <div class="prof_edit_01">パスワード<br><span>編集中</span></div>
            <div class="prof_edit_editbox">
                <div class="pee_tit pee_tit_first">現在のパスワード
                    <a href="{{ route('user.forgot_password') }}" class="pee_pass_link">
                        現在のパスワードを忘れた方はこちらから
                    </a>
                </div>
                <div class="pee_now">*********</div>

                <div class="pee_tit">新しいパスワード<span class="prof_edit_editbox_desc">　半角英数字のみ</span></div>
                <input name="new_password" type="password"/>

                <div class="pee_tit">新しいパスワード（確認用）
                    {{-- <span class="prof_edit_editbox_desc">　コピー＆ペースト不可</span> --}}
                </div>
                <input name="new_password_confirmation" type="password"/>

            </div>
            <div class="prof_edit_03">
                <a href="javascript:document.passwordForm.submit()">更新</a>
            </div>
        </div>
    </form>
@elseif(Request::get('input_type') === 'inviter_code')
    <form action="{{ route('user.update_profile', ['user' => Auth::user()]) }}" method="POST" name="urlForm">
        @method('PATCH')
        @csrf
        <div class="prof_edit_row">
            <div class="prof_edit_01">ユーザー名<br><span>編集中</span></div>
            <div class="prof_edit_editbox">
                <input name="url" type="text" placeholder="UserId" value="{{ old('url', Auth::user()->profile->inviter_code) }}"/>
            </div>
            <div class="prof_edit_03">
                <a href="javascript:document.urlForm.submit()">更新</a>
            </div>
        </div>
    </form>
{{-- @elseif(Request::get('input_type') === 'birthday')
<form action="{{ route('user.update_profile', ['user' => Auth::user()]) }}" method="POST">
    @method('PATCH')
    @csrf
    <div class="prof_edit_row">
        <div class="prof_edit_01">生年月日<br><span>編集中</span></div>
        <div class="prof_edit_editbox pee_select_hori">
            <div class="cp_ipselect cp_normal">
                <select name="year">
                    <option value="">年</option>
                    <option value="1930">1930</option>
                    <option value="2020">2020</option>
                </select>
            </div>
            <div class="cp_ipselect cp_normal">
                <select name="month">
                    <option value="">月</option>
                    <option value="1">1</option>
                    <option value="12">12</option>
                </select>
            </div>
            <div class="cp_ipselect cp_normal">
                <select name="day">
                    <option value="">日</option>
                    <option value="1">1</option>
                    <option value="31">31</option>
                </select>
            </div>
            <div class="cp_ipselect cp_normal">
                <select name="koukai">
                    <option value="yes">公開する</option>
                    <option value="no">公開しない</option>
                </select>
            </div>
        </div>
        <div class="prof_edit_03">
            <button type="submit">更新</button>
        </div>
    </div>
</form> --}}
@elseif(Request::get('input_type') === 'gender')
    <form action="{{ route('user.update_profile', ['user' => Auth::user()]) }}" method="POST" name="genderForm">
        @method('PATCH')
        @csrf
        <div class="prof_edit_row">
			<div class="prof_edit_01">性別<br><span>編集中</span></div>
			<div class="prof_edit_editbox pee_select_hori">
				<div class="cp_ipselect cp_normal">
					<select name="gender">
                        <option value="女性">女性</option>
						<option value="男性">男性</option>
                        <option value="その他">その他</option>
					</select>
				</div>
				<div class="cp_ipselect cp_normal">
					<select name="gender_is_published">
                        <option value="1">公開する</option>
                        <option value="0">公開しない</option>
                    </select>
				</div>
			</div>
			<div class="prof_edit_03">
                <a href="javascript:document.genderForm.submit()">更新</a>
            </div>
		</div>
    </form>
@elseif(Request::get('input_type') === 'introduction')
    <form action="{{ route('user.update_profile', ['user' => Auth::user()]) }}" method="POST" name="introductionForm">
        @method('PATCH')
        @csrf
        <div class="prof_edit_row">
			<div class="prof_edit_01">自己紹介<br><span>編集中</span></div>
			<div class="prof_edit_editbox">
				<textarea rows="8" name="introduction"></textarea>
			</div>
			<div class="prof_edit_03">
                <a href="javascript:document.introductionForm.submit()">更新</a>
            </div>
        </div>
    </form>
@else
    <div class="prof_edit_row">
        <div class="prof_edit_01">ユーザー名</div>
        <div class="prof_edit_02">{{ Auth::user()->name }}</div>
        <div class="prof_edit_03">
            編集
            <a href="{{ route('user.profile', ['input_type' => 'name']) }}" class="cover_link"></a>
        </div>
    </div>
    <div class="prof_edit_row">
        <div class="prof_edit_01">プロフィール写真</div>
        <div class="prof_edit_02"></div>
        <div class="prof_edit_03">
            編集
            <a href="{{ route('user.profile', ['input_type' => 'image_url']) }}" class="cover_link"></a>
        </div>
    </div>
    <div class="prof_edit_row">
        <div class="prof_edit_01">メールアドレス</div>
        <div class="prof_edit_02">{{ Auth::user()->email }}</div>
        <div class="prof_edit_03">
            編集
            <a href="{{ route('user.profile', ['input_type' => 'email']) }}" class="cover_link"></a>
        </div>
    </div>
    <div class="prof_edit_row">
        <div class="prof_edit_01">パスワード</div>
        <div class="prof_edit_02">********</div>
        <div class="prof_edit_03">
            編集
            <a href="{{ route('user.profile', ['input_type' => 'password']) }}" class="cover_link"></a>
        </div>
    </div>
    <div class="prof_edit_row">
        <div class="prof_edit_01">URL</div>
        <div class="prof_edit_02">{{ Auth::user()->profile->inviter_code }}</div>
        <div class="prof_edit_03">
            編集
            <a href="{{ route('user.profile', ['input_type' => 'inviter_code']) }}" class="cover_link"></a></div>
    </div>
    {{-- <div class="prof_edit_row">
        <div class="prof_edit_01">現在地</div>
        <div class="prof_edit_02">設定されていません</div>
        <div class="prof_edit_03">編集<a href="★" class="cover_link"></a></div>
    </div> --}}
    {{-- <div class="prof_edit_row">
        <div class="prof_edit_01">生年月日</div>
        <div class="prof_edit_02">設定されていません</div>
        <div class="prof_edit_03">編集<a href="{{ route('user.profile', ['input_type' => 'birthday']) }}" class="cover_link"></a></div>
    </div> --}}
    <div class="prof_edit_row">
        <div class="prof_edit_01">性別</div>
        <div class="prof_edit_02">
            @if(isset(Auth::user()->profile->gender))
                {{ Auth::user()->profile->gender }}
            @else
                設定されていません
            @endif
        </div>
        <div class="prof_edit_03">編集<a href="{{ route('user.profile', ['input_type' => 'gender']) }}" class="cover_link"></a></div>
    </div>
    <div class="prof_edit_row">
        <div class="prof_edit_01">自己紹介</div>
        <div class="prof_edit_02">
        @if(isset(Auth::user()->profile->introduction))
            {{ Auth::user()->profile->introduction }}
        @else
            設定されていません
        @endif
        </div>
        <div class="prof_edit_03">編集<a href="{{ route('user.profile', ['input_type' => 'introduction']) }}" class="cover_link"></a></div>
    </div>
@endif
</div>
