<div class='row justify-content-center mt-5'>
    <div class='col-sm-10'>
        <a class="btn btn-danger mb-2 d-block" href={{ route($guard.'.sns_login.redirect', 'google') }}
            role="button">Googleでログイン
        </a>
        <a class="btn mb-2 d-block" href={{ route($guard.'.sns_login.redirect', 'twitter') }} role="button"
            style='background-color:#1da1f2 ;color:white;'>Twitterでログイン
        </a>
        <a class="btn mb-2 d-block" href={{ route($guard.'.sns_login.redirect', 'facebook') }} role="button"
            style='background-color:#3c5a99; color:white;'>Facebookでログイン
        </a>
        <a class="btn mb-2 d-block" href={{ route($guard.'.sns_login.redirect', 'line') }} role="button"
            style='background-color:#00c300; color:white;'>LINEでログイン
        </a>
    </div>
</div>
