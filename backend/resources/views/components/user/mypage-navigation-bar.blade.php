<div class="fixedcontainer mypage_contents my-page_header">
    <ul id="my-page_header-menu" class="sm sm-clean" data-smartmenus-id="16131297636922026">
        <li><a href="{{ route('user.payment_history') }}">購入履歴</a></li>
        <li><a href="{{ route('user.purchased_projects') }}">応援購入した<br>プロジェクト一覧</a></li>
        <li><a href="{{ route('user.liked_projects') }}">お気に入り<br>プロジェクト一覧</a></li>
        <li onmouseover="mouseOverMessageOptions()" onmouseleave="mouseLeaveMessageOptions()"><a href="#">やりとり</a></li>
        <div class="message_options" id="message_options" style="display:none;" onmouseover="mouseOverMessageOptions()"
            onmouseleave="mouseLeaveMessageOptions()">
            <p><a href="{{ route('user.contribution_comments') }}">投稿コメント一覧</a></p>
            <p><a href="{{ route('user.message.index') }}">メッセージ一覧</a></p>
        </div>
        <li onmouseover="mouseOverSettingsOptions()" onmouseleave="mouseLeaveSettingOptions()"><a href="#">各種設定</a></li>
        <div class="setting_options" id="setting_options" style="display:none;" onmouseover="mouseOverSettingsOptions()"
            onmouseleave="mouseLeaveSettingOptions()">
            <p><a href="{{ route('user.profile') }}">プロフィール編集</a></p>
        </div>

    </ul>
</div>

<script>
    let message_options = document.getElementById("message_options");
    let setting_options = document.getElementById("setting_options");

function mouseOverMessageOptions(){
    message_options.style.display = "block";
}
function mouseLeaveMessageOptions(){
    message_options.style.display = "none";
}


function mouseOverSettingsOptions(){
    setting_options.style.display = "block";
}
function mouseLeaveSettingOptions(){
    setting_options.style.display = "none";
}
</script>
