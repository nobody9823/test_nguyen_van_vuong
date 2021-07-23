<form action="{{ route('user.my_project.project.update', ['project' => $project]) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form_item_row">
        <div class="form_item_tit">本文<span class="hissu_txt">必須</span><span style="font-weight: normal;font-size: 1.2rem;">※300文字以内で入力してください</span></div>
        <textarea name="ps_plan_content" class="def_textarea tiny_editor" rows="6">{{ old('ps_plan_content', optional($project)->ps_plan_content) }}</textarea>
    </div>
    <div class="def_btn">
        <button type="submit" class="disable-btn">
            <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">保存する</p>
        </button>
    </div>
</form>
