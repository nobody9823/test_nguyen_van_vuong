<div class="my_project_container">
    @foreach($project->plans as $plan)
    <div class="my_plan_img_box_wrapper">
        <div class="my_plan_checkbox">
            <input type="checkbox" id="{{ $plan->id }}" name="returns" class="ac_list_checks" value="{{ $plan->id }}"> 
            <label for="{{ $plan->id }}" value="{{ $plan->id }}" class="checkbox-fan"></label>
        </div>
        <div>
            <div class="spinner" id="spinner_return{{ '_'.$plan->id }}"></div>
            <i class="fa fa-check-circle green" aria-hidden="true" id="saved_return{{ '_'.$plan->id }}"></i>
            <span id="errors_return{{ '_'.$plan->id }}" style="color: red;"></span>
        </div>
        <div class="my_project_img_wrapper pds_sec02_img">
            <img src="{{ asset(Storage::url($plan->image_url)) }}">
            <a class="cover_link" onclick="openPlanFormModal({{ $plan->id }})"></a>
        </div>

        <div class="price">{{ $plan->price }}円</div>

        <div class="title">{{ Str::limit($plan->title, 46) }}</div>

        <div class="content">
            {{ Str::limit($plan->content, 170) }}
        </div>

        @if($plan->limit_of_supporters_is_required === 1 && $plan->limit_of_supporters > 0)
            <div class="text">限定数：{{ $plan->limit_of_supporters }}</div>
        @else()
            <div class="text">限定数：なし</div>
        @endif

        <div class="text">住所情報の取得：{{ $plan->address_is_required === 0 ? '要' : '不要' }}</div>
        <div class="text">{{ $plan->formatted_delivery_date }}末までにお届け予定</div>

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
<a href="{{ route('user.project.create_return', ['project' => $project]) }}" class="footer-over-L-return my_new_project" id="create_new_return_button">
    <div class="footer-over_L_02">
    <div class="footer-over_L_02_01">New Return</div>
    <div class="footer-over_L_02_02">新規リターン作成はこちら</div>
    </div>
    <div class="footer-over_L_03"><i class="fas fa-chevron-right"></i></div>
</a>

<div id="copy_return" name="copy_return" class="def_btn btn_margin_bottom hidden_button">
    選択したリターンを複製する
    <a class="cover_link"></a>
</div>

<x-common.navigating_page_buttons :project="$project" nextPageButtonForReturn="necessary" />

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
    </div>
</section>

<script>
    $(':checkbox[name="returns"]').click(function() {
        var returns = $(':checkbox[name="returns"]:checked').val();
        if (returns != null) {
            $("#copy_return").removeClass("hidden_button");
        } else {
            $("#copy_return").addClass("hidden_button");
        }
    })
    $('#copy_return').click(function() {
        var checkedreturns = [];
        $(':checkbox[name="returns"]:checked').each(function() {
            checkedreturns.push(this.id)
        })
        updateMyReturn.copyReturns(this, "{{ $project->id }}", checkedreturns)
    })
</script>
