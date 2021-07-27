<!-- マイプロジェクトの「保存する」「プロジェクト一覧へ戻る」ボタン -->
<br>
@if(!isset($saveButton))
<div class="def_btn">
    <button type="submit" class="disable-btn">
        <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">保存する</p>
    </button>
</div>
@endif

<div class="def_btn">
    <button type="submit" class="disable-btn">
        <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">プロジェクト一覧へ戻る</p>
    </button>
</div>