<div class="plan">
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
</div>
