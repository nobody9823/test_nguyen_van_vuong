<!-- マイプロジェクトの「保存する」「プロジェクト一覧へ戻る」ボタン -->

@if(isset($nextPageButtonForReturn))
<div class="def_btn">
    <a style="font-size: 1.8rem;font-weight: bold;color: #fff; display: block" href="{{ route('user.my_project.project.edit', ['project' => $project, 'next_tab' => 'ps_return']) }}">
        次へ進む
    </a>
</div>
@elseif (!isset($nextPageButton))
<div class="def_btn">
    <button type="submit" class="disable-btn">
        <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">次へ進む</p>
    </button>
</div>
@endif

<div class="def_btn">
    <a style="font-size: 1.8rem;font-weight: bold;color: #fff; display: block" href="{{ route('user.my_project.project.index') }}">
        プロジェクト一覧へ戻る
    </a>
</div>

<!-- @if (isset($previewForPsReturn))
<div class="def_btn">
    <a 
        style="font-size: 1.8rem;font-weight: bold;color: #fff; display: block" 
        href="{{ route('user.my_project.reward_preview', ['project' => $project])}}"
        target="_blank"
    >
        PSリターンプレビュー
    </a>
</div>
@else
<div class="def_btn">
    <a 
        style="font-size: 1.8rem;font-weight: bold;color: #fff; display: block" 
        href="{{ route('user.project_preview', ['project' => $project] )}}"
        target="_blank"
    >
        プロジェクトプレビュー
    </a>
</div>
@endif -->
