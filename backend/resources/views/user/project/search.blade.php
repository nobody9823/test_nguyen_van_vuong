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

@section('script')
<!-- クリアボタンを押すと検索項目がクリアされる処理 -->
<script src="{{ asset('/js/clear-search-entry.js') }}"></script>
<script src="{{ asset('/js/search-project.js') }}"></script>
<script>
    // csrfトークンを下記のproject-liked.jsファイルに送信
    window.Laravel = {};
    window.Laravel.csrfToken = @json( csrf_token() );
</script>
<script src="{{ asset('/js/project-liked.js') }}"></script>

@endsection
