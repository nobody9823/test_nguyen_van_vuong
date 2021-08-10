@extends('user.layouts.base')

@section('title', 'Dashboard')

@section('content')
<section class="section_base">
    <div class="def_inner inner_item">
        <div class="tit_L_01 E-font"><h2>CANCEL THE ACCOUNT</h2><div class="sub_tit_L">退会確認</div></div>
        <form class="" action={{route('user.delete_user',['user' => Auth::user()])}} method='post'>
            @method('delete')
            @csrf
            <div class="form_item_row" style="text-align: center;">
                <div class="form_item_tit">
                    退会すると、今まで支援したプロジェクトの履歴や購入履歴などが閲覧できなくなります。<br>
                    本当に退会してよろしいですか？<br>
                </div>
            </div>

            <div class="def_btn">
                <button type="submit" class="disable-btn">
                    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">退会する</p>
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
