<div class="login_other" style="text-align: center;">または</div>

<div class="login_social" 
style="display: flex;
       flex-direction: column;
       align-items: center;">
    <a class="my-page_btn" id="google_login_link" href="{{ route('user.sns_login.redirect', 'google') }}">
        <span class="icon"><i class="fab fa-google"></i></span>
        Googleアカウントでログインする
    </a>

    <a class="my-page_btn" id="twitter_login_link" href="{{ route('user.sns_login.redirect', 'twitter') }}">
        <span class="icon"><i class="fab fa-twitter"></i></span>
        Twitterアカウントでログインする
    </a>

    <a class="my-page_btn" id="facebook_login_link" href="{{ route('user.sns_login.redirect', 'facebook') }}">
        <span class="icon"><i class="fab fa-facebook-f"></i></span>
        Facebookアカウントでログインする
    </a>

    <a class="my-page_btn" id="line_login_link" href="{{ route('user.sns_login.redirect', 'line') }}">
        <span class="icon"><img src="./image/line-icon.svg"></span>
        LINEアカウントでログインする
    </a>
</div>
