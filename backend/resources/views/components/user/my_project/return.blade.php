<div class="my_new_project_wrapper">

    <section id="pc-top_04" class="section_base">
        <div class="img_box_02">
            @foreach($project->plans as $plan)
            <div class="img_box_02_item">
                <div class="spinner-wrapper">
                    <div class="spinner" id="spinner_return{{ '_'.$plan->id }}"></div>
                    <i class="fa fa-check-circle green" aria-hidden="true" id="saved_return{{ '_'.$plan->id }}"></i>
                    <span id="errors_return{{ '_'.$plan->id }}" style="color: red;"></span>
                </div>
                <div class="ib02_01 E-font my_project_img_wrapper">
                    <img src="{{ Storage::url($plan->image_url) }}">
                    <a class="cover_link" onclick="DisplayEditPlan({{ $plan->id }});" id="{{ $plan->id }}"></a>
                </div>

                <div class="ib02_03">
                    <h3>{{ Str::limit($plan->title, 46) }}</h3>
                    <a class="cover_link" onclick="DisplayEditPlan({{ $plan->id }});" id="{{ $plan->id }}"></a>
                </div>

                <div class="pds_sec02_01_btn">
                    編集
                    <a class="cover_link" onclick="DisplayEditPlan({{ $plan->id }});" id="{{ $plan->id }}"></a>
                </div>
                <div class="pds_sec02_01_btn">
                    削除
                    <a class="cover_link" onclick="updateMyPlan.deletePlan(this, {{ $project->id }}, {{ $plan->id }});" id="{{ $plan->id }}"></a>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    @foreach($project->plans as $plan)
    <section class="edit_plan_form_sections" id="edit_plan_form_section_{{ $plan->id }}" style="display: none;">
        <form method="post" action="{{ route('user.plan.update', ['project' => $project, 'plan' => $plan , 'current_tab' => 'return']) }}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <x-user.my_plan.plan-form :plan="$plan" :project="$project" />
        </form>
    </section>
    @endforeach

    {{--NOTICE: MyProjectController, create action --}}
    <a href="javascript:updateMyPlan.DisplayPlanForm({{ $project->id }})" class="footer-over_L my_new_project">
        <div class="footer-over_L_02">
        <div class="footer-over_L_02_01">New Project</div>
        <div class="footer-over_L_02_02">新規リターン作成はこちら</div>
        </div>
        <div class="footer-over_L_03"><i class="fas fa-chevron-right"></i></div>
    </a>
</div>

<section id="plan_form_section" style="display: none;">
    <form method="post" action="{{ route('user.plan.store', ['project' => $project, 'current_tab' => 'return']) }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="plan_id" name="plan_id">
        <x-user.my_plan.plan-form :plan=null :project=$project />
    </form>
</section>

<div class="def_btn">
    <a style="font-size: 1.8rem;font-weight: bold;color: #fff; display: block" href="{{ route('user.my_project.project.edit', ['project' => $project, 'next_tab' => 'ps_return']) }}">
        次へ進む
    </a>
</div>
<x-common.save_back_button saveButton="unnecessary" />
