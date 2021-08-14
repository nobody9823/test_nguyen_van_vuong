@extends('user.layouts.base')

@section('content')
<main>
    <x-user.search />
    <div class="main_inner">
        <section id="pc-top_04" class="section_base">
            <div class="tit_L_01"></div>

            <div class="img_box_02">
                @foreach($projects as $project)
                <div class="img_box_02_item">
                    <x-user.project.project-card :project="$project" :userLiked="$user_liked" cardSize="" ranking="" />
                </div>
                @endforeach
            </div>
        </section>

        <x-common.pagination :props="$projects"/>
    </div>
</main>
@endsection

@section('css')
<style>
    nav {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        --breakpoint-xs: 0;
        --breakpoint-sm: 576px;
        --breakpoint-md: 768px;
        --breakpoint-lg: 992px;
        --breakpoint-xl: 1200px;
        --font-family-sans-serif: "Nunito", sans-serif;
        --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        font-family: "Nunito", sans-serif;
        font-size: 0.9rem;
        font-weight: 400;
        line-height: 1.6;
        color: #212529;
        text-align: center !important;
        box-sizing: border-box;
        display: block;
    }

    .pagination {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        --breakpoint-xs: 0;
        --breakpoint-sm: 576px;
        --breakpoint-md: 768px;
        --breakpoint-lg: 992px;
        --breakpoint-xl: 1200px;
        --font-family-sans-serif: "Nunito", sans-serif;
        --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        font-family: "Nunito", sans-serif;
        font-size: 0.9rem;
        font-weight: 400;
        line-height: 1.6;
        color: #212529;
        text-align: center !important;
        box-sizing: border-box;
        margin-top: 0;
        margin-bottom: 1rem;
        display: flex;
        padding-left: 0;
        list-style: none;
        border-radius: 0.25rem;
    }

    .page-item {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        --breakpoint-xs: 0;
        --breakpoint-sm: 576px;
        --breakpoint-md: 768px;
        --breakpoint-lg: 992px;
        --breakpoint-xl: 1200px;
        --font-family-sans-serif: "Nunito", sans-serif;
        --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        font-family: "Nunito", sans-serif;
        font-size: 0.9rem;
        font-weight: 400;
        line-height: 1.6;
        color: #212529;
        list-style: none;
        box-sizing: border-box;
    }

    li span {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        --breakpoint-xs: 0;
        --breakpoint-sm: 576px;
        --breakpoint-md: 768px;
        --breakpoint-lg: 992px;
        --breakpoint-xl: 1200px;
        --font-family-sans-serif: "Nunito", sans-serif;
        --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        font-family: "Nunito", sans-serif;
        font-size: 0.9rem;
        font-weight: 400;
        list-style: none;
        box-sizing: border-box;
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        border: 1px solid #dee2e6;
        z-index: 3;
        color: #fff;
        background-color: #ff1493;
        border-color: #ff1493;
    }

    li a {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        --breakpoint-xs: 0;
        --breakpoint-sm: 576px;
        --breakpoint-md: 768px;
        --breakpoint-lg: 992px;
        --breakpoint-xl: 1200px;
        --font-family-sans-serif: "Nunito", sans-serif;
        --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        font-family: "Nunito", sans-serif;
        font-size: 0.9rem;
        font-weight: 400;
        line-height: 1.25;
        list-style: none;
        box-sizing: border-box;
        position: relative;
        padding: 0.5rem 0.75rem;
        margin: 0;
        word-break: normal;
        background-color: transparent;
        color: inherit;
        height: 100%;
        display: block;
        outline: none;
        text-decoration: none;
    }
</style>
@endsection

@section('script')
<!-- クリアボタンを押すと検索項目がクリアされる処理 -->
<script src="{{ asset('/js/clear-search-entry.js') }}"></script>

<script>
    // csrfトークンを下記のproject-liked.jsファイルに送信
    window.Laravel = {};
    window.Laravel.csrfToken = @json( csrf_token() );
</script>
<script src="{{ asset('/js/project-liked.js') }}"></script>

@endsection
