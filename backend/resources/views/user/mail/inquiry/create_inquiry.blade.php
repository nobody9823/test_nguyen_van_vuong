@extends('user.layouts.base')

@section('title', 'お問い合わせ')

@section('content')

<div class="content">
    <div class="section">
        <div class="fixedcontainer mypage_contents sign-in_box">
            <h2><i class="fas fa-envelope"></i>お問い合わせ</h2>
            <form action="{{ route('user.inquiry.send') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name" class="control-label">氏名</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="email" class="control-label">メールアドレス</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="tel" class="control-label">電話番号</label>
                    <input type="tel" name="tel" class="form-control" id="tel" value="{{ old('tel') }}">
                </div>

                <div class="form-group">
                    <label for="inquiry-category" class="control-label">お問い合わせ種別</label>
                    <div class="select_item_main">
                        <select name="inquiry_category" id="inquiry-category">
                            <option></option>
                            @foreach($inquiry_categories as $inquiry_category)
                            <option value="{{$inquiry_category}}" {{ old('inquiry_category')== $inquiry_category ? 'selected' : '' }}>
                                {{$inquiry_category}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inquiry-content" class="control-label">お問い合わせ内容</label>
                    <textarea name="inquiry_content" class="form-control textarea_item" id="inquiry-content">{{ old('inquiry_content') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image-upload" class="control-label">添付ファイル</label>

                    <div class="user_profile_img">
                        <label class="btn-image-upload" style="cursor: pointer;">
                            <i class="far fa-image"></i>
                            <input type="file" name="images[]" style="display: none;" class="image_file" id="numberOfFiles" value="{{ old('image') }}" multiple="multiple" onchange="uploadImage(this);">
                            <p>画像をアップロードする<br>縦横比200px*200px以上の画像推奨</p>
                        </label>
                    </div>
                </div>

                <div id="preview"></div>

                <button type="submit" id="send" class="my-page_btn">送信</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/uploaded-images-preview.js') }}"></script>
@endsection
