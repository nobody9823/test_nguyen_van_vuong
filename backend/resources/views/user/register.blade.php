@extends('user.layouts.base')

@section('title', '本登録画面')

@section('seo_pack')
<script type="application/ld+json" class="aioseop-schema">
    {"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"https://work-x.work/#organization","url":"https://work-x.work/","name":"Work-X","sameAs":[]},{"@type":"WebSite","@id":"https://work-x.work/#website","url":"https://work-x.work/","name":"Work-X","publisher":{"@id":"https://work-x.work/#organization"},"potentialAction":{"@type":"SearchAction","target":"https://work-x.work/?s={search_term_string}","query-input":"required name=search_term_string"}},{"@type":"WebPage","@id":"https://work-x.work#webpage","url":"https://work-x.work","inLanguage":"ja","name":"Work-X","isPartOf":{"@id":"https://work-x.work/#website"},"breadcrumb":{"@id":"https://work-x.work#breadcrumblist"},"description":"不動産業界の転職サイト","datePublished":"2020-11-30T12:44:03+09:00","dateModified":"2020-11-30T12:45:47+09:00","about":{"@id":"https://work-x.work/#organization"}},{"@type":"BreadcrumbList","@id":"https://work-x.work#breadcrumblist","itemListElement":[{"@type":"ListItem","position":1,"item":{"@type":"WebPage","@id":"https://work-x.work/","url":"https://work-x.work/","name":"Work-X"}}]}]}
</script>
<link rel="canonical" href="https://work-x.work/">
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/custom/top.css') }}">
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/custom/top.js') }}"></script>
@endsection

@section('jetpack_meta')
<meta property="og:type" content="website">
<meta property="og:title" content="Work-X">
<meta property="og:description" content="新規登録画面">
<meta property="og:url" content="https://work-x.work/">
<meta property="og:site_name" content="Work-X">
<meta property="og:image" content="https://s0.wp.com/i/blank.jpg">
<meta property="og:locale" content="ja_JP">
<meta name="twitter:text:title" content="トップページ">
<meta name="twitter:card" content="summary">
@endsection

@section('body_class', 'home page-template-default page page-id-42 slider_type2 show_page_header_type2')

@section('content')
<div class="content" style=" background: #f5f5f5; padding: 80px 0;">
    <div class="section">
        <div class="fixedcontainer mypage_contents sign-in_box">
            <h2><i class="fas fa-sign-in-alt"></i>本登録</h2>
            <form action={{route('user.register',['token' => $token])}} method='post'>
                @csrf
                <div class="form-group user_login">
                    {{ Form::label('name', 'お名前', ['class' =>  'control-label']) }}
                    <input style="margin-bottom: 10px;" name='name' type="text"
                        class={{"form-control".($errors->has('name') ? ' is-invalid' : '')}} placeholder='お名前'
                        value="{{ old('name') }}" required>
                    {{ Form::label('password', 'パスワード', ['class' =>  'control-label']) }}
                    <input style="margin-bottom: 10px;" name='password' type="password"
                        class={{"form-control".($errors->has('name') ? ' is-invalid' : '')}} placeholder='パスワード'
                        value="{{ old('password') }}" required>
                    {{ Form::label('password_confirmation', '確認パスワード', ['class' =>  'control-label']) }}
                    <input style="margin-bottom: 10px;" name='password_confirmation' type="password"
                        class={{"form-control".($errors->has('name') ? ' is-invalid' : '')}} placeholder='確認パスワード'
                        value="{{ old('password_confirmation') }}" required>
                </div>
                <div class="my-page_checkbox">
                    <input type="checkbox" required>
                    <a href="{{ route('user.terms') }}">利用規約</a>
                    <p>と</p>
                    <a href="{{ route('user.privacy_policy') }}">プライバシーポリシー</a>
                    <p>に同意する</p>
                </div>
                <div class="submit-box">
                    <input type="submit" name="" value="本登録を完了する" class="my-page_btn">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

</html>
