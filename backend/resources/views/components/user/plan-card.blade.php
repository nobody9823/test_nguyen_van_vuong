<div class="pds_sec02_box inner_item">
    <div class="pds_sec02_img">
        <img class="" src="{{ Storage::url($plan->image_url) }}">
    </div>
    <div class="pds_sec02_01">
        <div class="pds_sec02_01_en">{{ $plan->price }}円</div>
        <div class="pds_sec02_01_nokori_nin">残り：{{ $plan->limit_of_supporters }}人まで</div>
    </div>

    <div class="pds_sec02_txt">
        {{ $plan->title }}
    </div>
    <div class="pds_sec02_txt">
        {{ $plan->content }}
    </div>

    @if ($project->end_date < now())
        <div class="pds_sec02_01_btn">
            FINISHED
            <a class="cover_link"></a>
        </div>
    @elseif ($plan->limit_of_supporters > 0)
        <div class="pds_sec02_01_btn">
            このリターンを選択する
            <a href="{{ route('user.plan.selectPlans', ['project' => $project, 'plan' => $plan, 'inviter_code' => $inviterCode ?? '' ]) }}" class="cover_link"></a>
        </div>
    @elseif ($plan->limit_of_supporters <= 0)
        <div class="pds_sec02_01_btn">
            OUT OF STOCK
            <a class="cover_link"></a>
        </div>
    @endif


    <div class="pds_sec02_01">
        <div class="pds_sec02_01_shien_nin">支援者：{{ $plan->included_payments_count }}人</div>
        <div class="pds_sec02_01_day">お届け予定日：{{ $plan->formatted_delivery_date }}</div>
    </div>
</div>
{{-- <div class="plan">
    <h3 class="plan-price">{{ number_format($plan->price) }}円</h3>
    @if($plan->image_url == "Public/image/contribution.jpeg")
        <p class="plan-img"><img src="/image/contribution.jpeg"></p>
    @else
        <p class="plan-img"><img src="{{ asset(Storage::url($plan->image_url)) }}"></p>
    @endif
    <p class="plan-ttl">{{ $plan->title }}</p>
    <div class="plan-info">
        <p><strong>お返しお届け予定日</strong></p>
        <p>{{ $plan->estimated_return_date }}</p>
    </div>
    <input type="checkbox" name="plan_ids[]" class="plan_ids" onChange="Plans.planIsChecked(this)" id="{{ $plan->id }}" value="{{ $plan->price }}">
    <select name="plans[{{$plan->id}}]amount[]" id="plan_amount_{{ $plan->id }}" onChange="Plans.planAmountIsChanged(this)" disabled>
        @for($i = 1; $i <= $plan->limit_of_supporters; $i ++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
</div> --}}
