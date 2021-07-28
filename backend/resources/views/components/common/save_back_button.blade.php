<!-- マイプロジェクトの「保存する」「プロジェクト一覧へ戻る」ボタン -->
@if(!isset($saveButton))
<div class="def_btn">
    <button type="submit" class="disable-btn">
        <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">保存する</p>
    </button>
</div>
@endif

<div class="def_btn">
    <a style="font-size: 1.8rem;font-weight: bold;color: #fff; display: block" href="{{ route('user.my_project.project.index') }}">
        プロジェクト一覧へ戻る
    </a>
</div>
