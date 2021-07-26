<div class="my_new_project_wrapper">

    <section id="pc-top_04" class="section_base">
        <div class="img_box_02">
            @foreach($project->plans as $plan)
            <div class="img_box_02_item">
                <div class="ib02_01 E-font my_project_img_wrapper">
                    <img src="{{ Storage::url($plan->image_url) }}">
                    {{-- NOTICE: MyProjectController, show action --}}
                    <a href="#show" class="cover_link"></a>
                </div>

                <div class="ib02_03">
                    <h3>{{ Str::limit($project->title, 46) }}</h3>
                    {{-- NOTICE: MyProjectController, show action--}}
                    <a href="#show" class="cover_link"></a>
                </div>

                <div class="pds_sec02_01_btn">
                    編集
                    <a class="cover_link" onclick="DisplayEditPlan(this);" id="{{ $plan->id }}"></a>
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
            <x-user.my_plan.plan-form :plan="$plan" />
        </form>
    </section>
    @endforeach

    {{--NOTICE: MyProjectController, create action --}}
    <a href="javascript:DisplayPlanForm()" class="footer-over_L my_new_project">
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
        <x-user.my_plan.plan-form :plan=null />
    </form>
</section>