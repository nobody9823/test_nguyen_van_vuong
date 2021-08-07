<form action="{{ route('user.my_project.project.update', ['project' => $project, 'current_tab' => 'ps_return']) }}" method="post">
    @csrf
    @method('PUT')
    <div class="ps_plan_form_wrapper">
        <div class="ps_plan_form_item">
            <div class="form_item_tit">支援総額順リターン内容<span class="hissu_txt">必須</span><span class="disclaimer">※300文字以内で入力してください</span></div>
            <div class="spinner-wrapper">
                <div class="spinner" id="spinner_reward_by_total_amount"></div>
                <i class="fa fa-check-circle green" aria-hidden="true" style="display: none;" id="saved_reward_by_total_amount"></i>
            </div>
            <textarea name="reward_by_total_amount" class="def_textarea tiny_editor" rows="6">{{ old('reward_by_total_amount', optional($project)->reward_by_total_amount) }}</textarea>
        </div>
        <div class="ps_plan_form_item">
            <div class="form_item_tit">支援件数順リターン内容<span class="hissu_txt">必須</span><span class="disclaimer">※300文字以内で入力してください</span></div>
            <div class="spinner-wrapper">
                <div class="spinner" id="spinner_reward_by_total_quantity"></div>
                <i class="fa fa-check-circle green" aria-hidden="true" style="display: none;" id="saved_reward_by_total_quantity"></i>
            </div>
            <textarea name="reward_by_total_quantity" class="def_textarea tiny_editor" rows="6">{{ old('reward_by_total_quantity', optional($project)->reward_by_total_quantity) }}</textarea>
        </div>
    </div>

    <x-common.save_back_button />
</form>
