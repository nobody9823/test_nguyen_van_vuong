@foreach($payment->includedPlans as $plan)
<div>
    {{ $plan['title'] }}
    {{ $plan['content'] }}
    {{ $plan['delivery_date'] }}
    {{ $plan['price'] }}
    {{ $plan['image_url'] }}
</div>
@endforeach
<div>
    @if($payment->pay_jp_id !== null)
        {{ 'credit' }}
    @else
        {{ 'pay pay' }}
    @endif
    {{ Auth::user()->profile->first_name }}
    {{ Auth::user()->profile->last_name }}
    {{ Auth::user()->profile->first_name_kana }}
    {{ Auth::user()->profile->last_name_kana }}
    {{ Auth::user()->email }}
    {{ Auth::user()->profile->gender }}
    {{ Auth::user()->profile->phone_number }}
    {{ Auth::user()->address->postal_code }}
    {{ Auth::user()->address->prefecture }}
    {{ Auth::user()->address->city }}
    {{ Auth::user()->address->block }}
    {{ Auth::user()->address->building }}
    {{ Auth::user()->profile->birthday }}
    {{ $payment->remarks }}
    {{ $payment->comment->content }}
</div>
@if ($payment->pay_jp_id !== null)
    <a href="{{ route('user.plan.paymentForPayJp', ['project' => $project, 'payment' => $payment]) }}">決済する</a>
@else
    <a href="{{ $qr_code['data']['url'] }}">決済する</a>
@endif