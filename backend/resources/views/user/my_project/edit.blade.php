@extends('user.layouts.base')

@section('content')

<div class="Assist-input_base">
<section class="section_base">

    <div class="pc-Details-screen_base_top inner_item">

        <div class="pds_inner">
            <div class="pds_sec01">
                <div class="as_header_02 inner_item">プロジェクト詳細画面</div>
            </div>
        </div>
    </div>

    <div class=" def_inner inner_item">
        <div class="as_i_03">
            <div class="as_i_03_01">
                <div class="tab_container">
                    <input class="radio-fan" type="radio" id="target_amount_tag" name="project_edit_tag" value="target_amount" onClick="selectEditTag(this)" checked>
                    <label class="tab_item" for="target_amount_tag">目標金額</label>
                    <input class="radio-fan" type="radio" id="overview_tag" name="project_edit_tag" value="overview" onClick="selectEditTag(this)">
                    <label class="tab_item" for="overview_tag">概要</label>
                    <input class="radio-fan" type="radio" id="visual_tag" name="project_edit_tag" value="visual" onClick="selectEditTag(this)">
                    <label class="tab_item" for="visual_tag">ビジュアル</label>
                    <input class="radio-fan" type="radio" id="main_content_tag" name="project_edit_tag" value="main_content" onClick="selectEditTag(this)">
                    <label class="tab_item" for="main_content_tag">本文</label>
                    <input class="radio-fan" type="radio" id="return_tag" name="project_edit_tag" value="return" onClick="selectEditTag(this)">
                    <label class="tab_item" for="return_tag">リターン</label>
                    <input class="radio-fan" type="radio" id="ps_return_tag" name="project_edit_tag" value="ps_return" onClick="selectEditTag(this)">
                    <label class="tab_item" for="ps_return_tag">PSリターン</label>
                    <input class="radio-fan" type="radio" id="identification_tag" name="project_edit_tag" value="identification" onClick="selectEditTag(this)">
                    <label class="tab_item" for="identification_tag">本人確認</label>
                </div>
            </div>
        </div>
        <div class="def_outer_gray">
            <div class=" def_inner inner_item">
                <section id="target_amount_section" class="my_project_section">
                    <x-user.my_project.target_amount :project="$project" />
                </section>
                <section style="display: none;" id="overview_section" class="my_project_section">
                    <x-user.my_project.overview :project="$project" :tags="$tags" />
                </section>
                <section style="display: none;" id="visual_section" class="my_project_section">
                    <x-user.my_project.visual :project="$project" :projectImages="$project->projectFiles()->where('file_content_type', 'image_url')->get()->toArray()" :projectVideo="$project->projectFiles()->where('file_content_type', 'video_url')->first()" />
                </section>
                <section style="display: none;" id="main_content_section" class="my_project_section">
                    <x-user.my_project.main_content :project="$project" />
                </section>
                <section style="display: none;" id="return_section" class="my_project_section">
                    <x-user.my_project.return :project="$project" />
                </section>
                <section style="display: none;" id="ps_return_section" class="my_project_section">
                    <x-user.my_project.ps_return :project="$project" />
                </section>
                <section style="display: none;" id="identification_section" class="my_project_section">
                    <x-user.my_project.identification />
                </section>
            </div>
        </div>

    </div>

</section>
</div>
@endsection

@section('script')
<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" type="text/javascript" charset="UTF-8"></script>
<script>
const selectEditTag = el => {
    let myProjectSections = document.querySelectorAll('.my_project_section');
    for(let $i = 0; $i < myProjectSections.length; $i ++){
        myProjectSections[$i].style.display = 'none';
    };
    document.getElementById(el.value + '_section').style.display = 'block';
};
const DisplayPlanForm = () => {
    let el = document.getElementById('plan_form_section');
    if(el.style.display === 'none'){
        el.style.display = 'block';
    } else {
        el.style.display = 'none';
    };
}
const DisplayEditPlan = (el) => {
    let PlanFormSections = document.querySelectorAll('.edit_plan_form_sections');
    for(let $i = 0; $i < PlanFormSections.length; $i ++){
        PlanFormSections[$i].style.display = 'none';
    }
    console.log(el);
    document.getElementById('edit_plan_form_section_' + el.id).style.display = 'block';
}
const displayInputFile = (el) => {
    let image = document.getElementById('project_image_' + el.id);
    if (image.style.display === 'none'){
        image.style.display = 'block';
    } else if (image.style.display === 'block'){
        image.style.display = 'none';
    }
}
</script>
@endsection