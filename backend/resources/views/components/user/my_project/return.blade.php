<div class="my_project_container">
    @foreach($project->plans as $plan)
    <div class="my_plan_img_box_wrapper">
        <div>
            <div class="spinner" id="spinner_return{{ '_'.$plan->id }}"></div>
            <i class="fa fa-check-circle green" aria-hidden="true" id="saved_return{{ '_'.$plan->id }}"></i>
            <span id="errors_return{{ '_'.$plan->id }}" style="color: red;"></span>
        </div>
        <div class="ib02_01 E-font my_project_img_wrapper">
            <img src="{{ Storage::url($plan->image_url) }}">
            <a class="cover_link" onclick="openPlanFormModal({{ $plan->id }})"></a>
        </div>

        <div class="ib02_03">
            <h3>{{ Str::limit($plan->title, 46) }}</h3>
            <a class="cover_link" onclick="openPlanFormModal({{ $plan->id }})"></a>
        </div>

        <div class="def_btn">
            編集
            <a class="cover_link" onclick="openPlanFormModal({{ $plan->id }})"></a>
        </div>
        <div class="def_btn">
            削除
            <a class="cover_link" onclick="updateMyPlan.deletePlan(this, {{ $project->id }}, {{ $plan->id }});" id="{{ $plan->id }}"></a>
        </div>
    </div>
    @endforeach
</div>

{{--NOTICE: MyProjectController, create action --}}
<a onclick="createNewPlanAndOpenModal({{ $project->id }})" class="footer-over_L my_new_project">
    <div class="footer-over_L_02">
    <div class="footer-over_L_02_01">New Return</div>
    <div class="footer-over_L_02_02">新規リターン作成はこちら</div>
    </div>
    <div class="footer-over_L_03"><i class="fas fa-chevron-right"></i></div>
</a>

<x-common.navigating_page_buttons />

{{-- 「編集」ボタンを押したときに表示されるモーダル部 --}}
@foreach($project->plans as $plan)
    <section class="plan_form_modal" id="plan_form_modal_{{ $plan->id }}">
        <div class="plan_form_modal_bg" onclick="closePlanFormModal({{ $plan->id }})"></div>
        <div class="plan_form_modal_content">
            <form method="post" action="{{ route('user.plan.update', ['project' => $project, 'plan' => $plan , 'current_tab' => 'return']) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <x-user.my_plan.plan-form :plan="$plan" :project="$project" />
            </form>
            <a style="cursor: pointer" onclick="closePlanFormModal({{ $plan->id }})">閉じる</a>
        </div>
    </section>
@endforeach

{{-- 「新規リターン作成」ボタンを押したときに表示されるモーダル部 --}}
<section class="plan_form_modal" id="new_plan_form_modal">
    <div class="plan_form_modal_bg" onclick="closeNewPlanFormModal()"></div>
    <div class="plan_form_modal_content">
        <form method="post" action="{{ route('user.plan.store', ['project' => $project, 'current_tab' => 'return']) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="new_plan_id" name="plan_id" value={{ $plan->id ?? '' }}>
            <x-user.my_plan.plan-form :plan=null :project=$project />
        </form>
        <a style="cursor: pointer" onclick="closeNewPlanFormModal()">閉じる</a>
    </div>
</section>
