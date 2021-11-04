<div class="prof_page_R">
@if(Request::get('input_type') === 'name')
    <form action="{{ route('user.update_profile', ['user' => $authUser]) }}" method="POST" name="nameForm">
        @method('PATCH')
        @csrf
        <div class="prof_edit_row">
            <div class="prof_edit_01">ユーザー名<br><span>編集中</span></div>
            <div class="prof_edit_editbox">
                <input name="name" type="text" placeholder="UserId" value="{{ old('name', $authUser->name) }}"/>
            </div>
            <div class="prof_edit_03">
            </div>
            <div class="def_btn">
                <button type="submit" class="disable-btn">
                    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">変更する</p>
                </button>
            </div>
        </div>
    </form>
@elseif(Request::get('input_type') === 'image_url')
    <form action="{{ route('user.update_profile', ['user' => $authUser]) }}" method="POST" name="imageForm" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="prof_edit_row">
            <div class="prof_edit_01">プロフィール写真<br><span>編集中</span></div>
            <div class="prof_edit_editbox">
                <input type="file" id="files_input" name="image_url" accept=".png, .jpg, .jpeg, .gif"><br><span class="prof_edit_editbox_desc">ファイルサイズは1MB以下<br>ファイル形式は jpeg、gif、png 形式のみ可</span>
            </div>
            <div class="prof_edit_03">
            </div>
            <div class="def_btn">
                <button type="submit" class="disable-btn">
                    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">変更する</p>
                </button>
            </div>
        </div>
    </form>
@elseif(Request::get('input_type') === 'email' && !$authUser->sns_user_exists)
    <form action="{{ route('user.update_profile', ['user' => $authUser]) }}" method="POST" name="mailForm">
        @method('PATCH')
        @csrf
        <div class="prof_edit_row">
            <div class="prof_edit_01">メールアドレス<br><span>編集中</span></div>
            <div class="prof_edit_editbox">
                <div class="pee_tit pee_tit_first">現在のメールアドレス</div>
                <div class="pee_now">{{ $authUser->email }}</div>

                <div class="pee_tit">新しいメールアドレス<span class="prof_edit_editbox_desc">　半角英数字のみ</span></div>
                <input name="email" type="email" required/>

                <div class="pee_tit">新しいメールアドレス（確認用）
                    {{-- <span class="prof_edit_editbox_desc">　コピー＆ペースト不可</span> --}}
                </div>
                <input name="email_confirmation" type="email" required/>
            </div>
            <div class="prof_edit_03">
            </div>
            <div class="def_btn">
                <button type="submit" class="disable-btn">
                    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">変更する</p>
                </button>
            </div>
        </div>
    </form>
@elseif(Request::get('input_type') === 'password' && !$authUser->sns_user_exists)
    <form action="{{ route('user.update_profile', ['user' => $authUser]) }}" method="POST" name="passwordForm">
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
                <input name="current_password" type="password"/>

                <div class="pee_tit">パスワード<span class="prof_edit_editbox_desc">　半角英数字のみ</span></div>
                <input name="password" type="password"/>

                <div class="pee_tit">パスワード（確認用）
                    {{-- <span class="prof_edit_editbox_desc">　コピー＆ペースト不可</span> --}}
                </div>
                <input name="password_confirmation" type="password"/>

            </div>
            <div class="prof_edit_03">
            </div>
            <div class="def_btn">
                <button type="submit" class="disable-btn">
                    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">変更する</p>
                </button>
            </div>
        </div>
    </form>
@elseif(Request::get('input_type') === 'sns_links')
    <form action="{{ route('user.update_profile', ['user' => $authUser, 'input_type' => 'sns_links']) }}" method="POST" name="urlForm">
        @method('PATCH')
        @csrf
        <div class="prof_edit_row">
            <div class="prof_edit_01">URL<br><span>編集中</span></div>
            <div class="prof_edit_editbox prof_edit_sns_links">
                <div>
                    <img src="{{ asset('image/twitter.png') }}" alt="">
                    <input name="twitter_url" type="text" placeholder="twitter" value="{{ old('twitter_url', $authUser->snsLink->twitter_url) }}">
                </div>
                <div>
                    <img src="{{ asset('image/instagram.png') }}" alt="">
                    <input name="instagram_url" type="text" placeholder="instagram" value="{{ old('instagram_url', $authUser->snsLink->instagram_url) }}">
                </div>
                <div>
                    <img src="{{ asset('image/youtube.png') }}" alt="">
                    <input name="youtube_url" type="text" placeholder="youtube" value="{{ old('youtube_url', $authUser->snsLink->youtube_url) }}">
                </div>
                <div>
                    <img src="{{ asset('image/tiktok.png') }}" alt="">
                    <input name="tiktok_url" type="text" placeholder="tiktok" value="{{ old('tiktok_url', $authUser->snsLink->tiktok_url) }}">
                </div>
                <div>
                    <img src="{{ asset('image/other_sns.png') }}" alt="">
                    <input name="other_url" type="text" placeholder="other" value="{{ old('other_url', $authUser->snsLink->other_url) }}">
                </div>
            </div>
            <div class="prof_edit_03">
            </div>
            <div class="def_btn">
                <button type="submit" class="disable-btn">
                    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">変更する</p>
                </button>
            </div>
        </div>
    </form>
@elseif(Request::get('input_type') === 'birth_place')
    <form action="{{ route('user.update_profile', ['user' => $authUser]) }}" method="POST" name="birthPlaceForm">
        @method('PATCH')
        @csrf
        <div class="prof_edit_row">
            <div class="prof_edit_01">出身地<br><span>編集中</span></div>
            <div class="prof_edit_editbox">
                <input name="birth_place" type="text" placeholder="例）東京都" value="{{ old('birth_place', $authUser->profile->birth_place) }}"/>
            </div>
            <div class="prof_edit_03">
            </div>
            <div class="def_btn">
                <button type="submit" class="disable-btn">
                    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">変更する</p>
                </button>
            </div>
        </div>
    </form>


@elseif(Request::get('input_type') === 'birthday')

<form action="{{ route('user.update_profile', ['user' => $authUser]) }}" method="POST" name="birthdayForm">
    @method('PATCH')
    @csrf
    <div class="prof_edit_row">
        <div class="prof_edit_01">生年月日<br><span>編集中</span></div>
        <div class="prof_edit_editbox pee_select_hori">
            <div class="cp_ipselect cp_normal">
                <select id="year" name="year">
                    <option value="">年</option>
                    <?php $years = array_reverse(range(today()->year - 100, today()->year)); ?>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ old('year', $authUser->profile->getYearOfBirth()) == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>

            <div class="cp_ipselect cp_normal">
                <select id="month" name="month">
                    <option value="">月</option>
                    @foreach(range(1, 12) as $month)
                        <option value="{{ $month }}" {{ old('month', $authUser->profile->getMonthOfBirth()) == $month ? 'selected' : '' }}>{{ $month }}</option>
                    @endforeach
                </select>
            </div>

            <div class="cp_ipselect cp_normal">
                <select id="day" name="day" data-old-value="{{ old('day', $authUser->profile->getDayOfBirth()) }}"></select>
            </div>
            <div class="cp_ipselect cp_normal">
                <select name="birthday_is_published">
                    <option value="1" {{ old('birthday_is_published', $authUser->profile->birthday_is_published) == "1" ? 'selected' : '' }}>公開する</option>
                    <option value="0" {{ old('birthday_is_published', $authUser->profile->birthday_is_published) == "0" ? 'selected' : '' }}>公開しない</option>
                </select>
            </div>
        </div>
        <div class="prof_edit_03">
        </div>
        <div class="def_btn">
            <button type="submit" class="disable-btn">
                <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">変更する</p>
            </button>
        </div>
    </div>
</form>

@elseif(Request::get('input_type') === 'gender')
    <form action="{{ route('user.update_profile', ['user' => $authUser]) }}" method="POST" name="genderForm">
        @method('PATCH')
        @csrf
        <div class="prof_edit_row">
			<div class="prof_edit_01">性別<br><span>編集中</span></div>
			<div class="prof_edit_editbox pee_select_hori">
				<div class="cp_ipselect cp_normal">
					<select name="gender">
                        <option value="女性" {{ old('gender', $authUser->profile->gender) === "女性" ? 'selected' : '' }}>女性</option>
                        <option value="男性" {{ old('gender', $authUser->profile->gender) === "男性" ? 'selected' : '' }}>男性</option>
                        <option value="その他" {{ old('gender', $authUser->profile->gender) === "その他" ? 'selected' : '' }}>その他</option>
					</select>
				</div>
				<div class="cp_ipselect cp_normal">
					<select name="gender_is_published">
                        <option value="1" {{ old('gender_is_published', $authUser->profile->gender_is_published) == "1" ? 'selected' : '' }}>公開する</option>
                        <option value="0" {{ old('gender_is_published', $authUser->profile->gender_is_published) == "0" ? 'selected' : '' }}>公開しない</option>
                    </select>
				</div>
			</div>
			<div class="prof_edit_03">
            </div>
            <div class="def_btn">
                <button type="submit" class="disable-btn">
                    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">変更する</p>
                </button>
            </div>
		</div>
    </form>
@elseif(Request::get('input_type') === 'introduction')
    <form action="{{ route('user.update_profile', ['user' => $authUser]) }}" method="POST" name="introductionForm">
        @method('PATCH')
        @csrf
        <div class="prof_edit_row">
			<div class="prof_edit_01">自己紹介<br><span>編集中</span></div>
			<div class="prof_edit_editbox">
				<textarea rows="8" name="introduction">{{ old('introduction', $authUser->profile->introduction) }}</textarea>
			</div>
			<div class="prof_edit_03">
            </div>
            <div class="def_btn">
                <button type="submit" class="disable-btn">
                    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">変更する</p>
                </button>
            </div>
        </div>
    </form>
@else
    <div class="prof_edit_row">
        <div class="prof_edit_01">ユーザー名</div>
        <div class="prof_edit_02">{{ $authUser->name }}</div>
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
        <div class="prof_edit_01">URL</div>
        <div class="prof_edit_02 my_sns_icon_wrapper">
            @if ($authUser->snsLink->twitter_url)
            <a href="{{ $authUser->snsLink->twitter_url }}"><img src="{{ asset('image/twitter.png') }}" alt=""></a>
            @endif
            @if ($authUser->snsLink->instagram_url)
            <a href="{{ $authUser->snsLink->instagram_url }}"><img src="{{ asset('image/instagram.png') }}" alt=""></a>
            @endif
            @if ($authUser->snsLink->youtube_url)
            <a href="{{ $authUser->snsLink->youtube_url }}"><img src="{{ asset('image/youtube.png') }}" alt=""></a>
            @endif
            @if ($authUser->snsLink->tiktok_url)
            <a href="{{ $authUser->snsLink->tiktok_url }}"><img src="{{ asset('image/tiktok.png') }}" alt=""></a>
            @endif
            @if ($authUser->snsLink->other_url)
            <a href="{{ $authUser->snsLink->other_url }}"><img src="{{ asset('image/other_sns.png') }}" alt=""></a>
            @endif
        </div>
        {{-- <div class="prof_edit_02">{{ $authUser->snsLink->twitter_url }}</div>
        <div class="prof_edit_02">{{ $authUser->snsLink->instagram_url }}</div>
        <div class="prof_edit_02">{{ $authUser->snsLink->youtube_url }}</div>
        <div class="prof_edit_02">{{ $authUser->snsLink->tiktok_url }}</div>
        <div class="prof_edit_02">{{ $authUser->snsLink->other_url }}</div> --}}

        <div class="prof_edit_03">
            編集
            <a href="{{ route('user.profile', ['input_type' => 'sns_links']) }}" class="cover_link"></a>
        </div>
    </div>
    <div class="prof_edit_row">
        <div class="prof_edit_01">出身地</div>
        <div class="prof_edit_02">
            @if($authUser->profile->birth_place !== '')
                {{ $authUser->profile->birth_place }}
            @else
                設定されていません
            @endif
        </div>
        <div class="prof_edit_03">
            編集
            <a href="{{ route('user.profile', ['input_type' => 'birth_place']) }}" class="cover_link"></a></div>
    </div>
    <div class="prof_edit_row">
        <div class="prof_edit_01">生年月日</div>
        <div class="prof_edit_02">
            @if($authUser->profile->birthday === '0001-01-01')
                設定されていません
            @else
                {{ $authUser->profile->birthday }}
            @endif
        </div>
        <div class="prof_edit_03">編集<a href="{{ route('user.profile', ['input_type' => 'birthday']) }}" class="cover_link"></a></div>
    </div>
    <div class="prof_edit_row">
        <div class="prof_edit_01">性別</div>
        <div class="prof_edit_02">
            @if(isset($authUser->profile->gender))
                {{ $authUser->profile->gender }}
            @else
                設定されていません
            @endif
        </div>
        <div class="prof_edit_03">編集<a href="{{ route('user.profile', ['input_type' => 'gender']) }}" class="cover_link"></a></div>
    </div>
    <div class="prof_edit_row">
        <div class="prof_edit_01">自己紹介</div>
        <div class="prof_edit_02">
        @if($authUser->profile->introduction !== '')
            <p>{{ $authUser->profile->introduction }}</p>
        @else
            設定されていません
        @endif
        </div>
        <div class="prof_edit_03">編集<a href="{{ route('user.profile', ['input_type' => 'introduction']) }}" class="cover_link"></a></div>
    </div>
    @if(!$authUser->sns_user_exists)
    <p class="prof_edit_editbox_desc prof_address_caution">メールアドレスとパスワードは公開されません</p>
    <div class="prof_edit_row">
        <div class="prof_edit_01">メールアドレス</div>
        <div class="prof_edit_02">{{ $authUser->email }}</div>
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
    @endif
@endif
</div>
