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

    @if( date($project->end_date < now()) || ($plan->limit_of_supporters === 0) )
        <p class="plan-btn-end">募集終了</p>
    @elseif( date($project->start_date) > now() )
        <p class="plan-btn-pre">公開前</p>
    @else
        <div class="plan-btn-wrap">
            <a href="{{ route('user.plan.show', ['project' => $project,'plan' => $plan]) }}" class="plan-btn">支援する</a>
        </div>
    @endif
</div>
