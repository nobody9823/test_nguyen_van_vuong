@extends('user.layouts.base')

@section('title', 'Dashboard')

@section('content')
<div class="content">
    <div class="section">

        <x-user.mypage-navigation-bar />

        <div class="fixedcontainer mypage_contents taikai_box">
            <h2><i class="fas fa-lock"></i>退会確認</h2>
            <form class="" action={{route('user.delete_user',['user' => Auth::user()])}} method='post'>
                @method('delete')
                @csrf
                <p>退会させると、今まで支援したプロジェクトの履歴や支援コメントの履歴が閲覧できなくなります。</p>
                <p>本当に退会してよろしいですか？</p>

                <div class="submit-box">
                    <input type="submit" name="" value="退会" class="my-page_btn caution_btn">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
