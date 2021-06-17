@extends('user.layouts.base')

@section('title', 'Dashboard')

@section('content')
<div class="content">
    <div class="section">

        <x-user.mypage-navigation-bar />
        <div class="fixedcontainer mypage_contents comment-list_box">
            <h2><i class="far fa-comments"></i>支援コメント一覧</h2>
            @foreach ($comments as $comment)

            <div class="my-page_comment-list">
                <div class="my-page_comment-tit_box">
                    <div class="my-page_comment-tit">{{Str::limit($comment->project->title,30)}} &gt;
                        {{date_format($comment->created_at,'Y年m月d日')}}にコメント
                    </div>
                    <div class="my-page_comment-post-icons">
                        @if ($comment->likedUsers)
                        <div><img src={{asset('image/liked-icon.png')}}>{{count($comment->likedUsers)}}</div>
                        @else
                        <div><img src={{asset('image/like-icon.png')}}></div>
                        @endif
                    </div>
                </div>
                <div class="my-com-box">
                    <div class="my-com-img"><img src="{{Storage::url($comment->image_url)}}"></div>
                    <div class="my-com">{{$comment->content}}</div>
                </div>
                @if($comment->repliesToSupporterComment)
                <div class="talent-box">
                    <div class="talent-com-img"><img
                            src="{{Storage::url($comment->repliesToSupporterComment->talent->image_url)}}"></div>
                    <div class="talent-com">{{$comment->repliesToSupporterComment->content}}
                        <div class="talent-com-date"><i class="fas fa-clock i_icon">
                            </i>{{date_format($comment->repliesToSupporterComment->created_at,'Y年m月d日')}}
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <!--/my-page_comment-list-->
            @endforeach


        </div>
    </div>
</div>
@endsection
