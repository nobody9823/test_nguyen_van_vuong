@extends('user.layouts.base')

@section('title', 'FanReturn運営とのダイレクトメッセージ')

@section('css')
<style type="text/css">
    div#hovering-grey:hover {
        background-color: #F7FDFF;
    }
</style>
@endsection

@section('content')
<section id="supported-projects" class="section_base">
    <div class="tit_L_01 E-font">
        <h2>DIRECT MESSAGE TO OPERATOR</h2>
        <div class="sub_tit_L">FanReturn運営とのダイレクトメッセージ</div>
    </div>
    <div class="prof_page_base inner_item">
        <div class="prof_page_L">
            <x-user.mypage-navigation-bar/>
        </div>
        <div class="prof_page_R">
            <div
                style='max-height:70vh; min-height:40vh; background-color: #fff; border: 1px solid #00aebd; margin-bottom: 1rem; padding: 0.5rem;overflow-y:scroll;'>
                <table id="scroll-inner">
                    @if ($admin_message->adminMessageContents->isNotEmpty())
                        @foreach ($admin_message->adminMessageContents as $messageContent)
                            @if($messageContent->message_contributor === 'ユーザー')
                                <x-common.message.content_from_user guard="user" :messageContent="$messageContent" />
                            @elseif($messageContent->message_contributor === '管理者')
                                <x-common.message.content_from_admin guard="user" :messageContent="$messageContent" />
                            @endif
                        @endforeach
                    @else
                        まだメッセージ履歴がありません
                    @endif
                </table>
            </div>
            <form action={{route('user.admin_message_content.store')}} method='post'
                enctype="multipart/form-data">
                @csrf
                <x-common.add_hidden_query />
                <div style=" display: flex; justify-content: flex-end">
                    <textarea name="content" cols="40" rows="4" placeholder="メッセージを送信" style="border: 1px solid #00aebd; width: 100%"
                        required></textarea>
                </div>
                <div class="form-file__body">
                    <input accept=".pdf, .jpg, .png" type="file" name="file_path" value="{{ old('file_path') }}">
                    <br/>
                    <label for="file_path">*ファイル形式は.pdf .jpg .png のいずれかになります。
                    </label>
                </div>
                <div class="def_btn">
                    <button type="submit" class="disable-btn">
                        <p style="font-size: 1.8rem;font-weight: bold;color: #fff;" id="send_message_button">送信</p>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@section('script')
<script type="text/javascript">
    let target = document.getElementById('scroll-inner');
    let sendMessageButton = document.getElementById('send_message_button');
    target.scrollIntoView(false);
    sendMessageButton.scrollIntoView(false);
</script>
@endsection

@section('css')
@stack('temporary_css')
@endsection
