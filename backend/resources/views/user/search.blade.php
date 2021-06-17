@extends('user.layouts.base')

@section('content')
<div class="content sub_content">
    <div class="fixedcontainer">
        <div class="breadcrumb">
            <p>
                <a href="/">TOP</a>　＞　<a href="/search">応援プロジェクト</a>
                {{ $categories != null ? '　＞　' : ''}}
                {{ $categories != null ? $categories[$_GET['category_id']] : ''}}
            </p>
        </div>
        <div class="project-search">
            <div class="search-sidebar">
                <x-user.search />
            </div>
            <div class="section search-result">
                <h2 class="sec-ttl">
                    検索結果:{{$projects->total().'件中'.$projects->firstItem().'~'.$projects->lastItem()}}件を表示
                </h2>
                <div class="project-list">
                    <x-user.project-card :projects="$projects" />
                </div>
                {{ $projects->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>
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
    // プロジェクトのお気に入り登録・解除処理
    $('.project-like').on('click', function() {
        var el = $(this);
        var projectId = el.attr('id');

        el.append('<meta name="csrf-token" content="{{ csrf_token() }}">');

        $.ajax({
            url: '/project/'+ projectId + '/liked',
            type: 'POST',
            data: {'project_id': projectId },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        })
        .then((res) => {
            console.log(res);
            if(res == "登録"){
                el.children('i').attr('class', 'fas fa-heart project-like-icon');
            } else if(res == "削除"){
                el.children('i').attr('class', 'far fa-heart project-like-icon');
            } else if (res == "未ログイン") {
                alert("ログインしてください");
            } else {
                alert("エラーが起こりました。");
            }
        })
        .fail((error)=>{
            console.log("エラーが起こりました。")
        })
    });
</script>

@endsection
