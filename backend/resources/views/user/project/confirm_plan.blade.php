@foreach($plans as $plan)
<div>
    {{ $plan->title }}
    {{ $plan->content }}
    {{ $plan->delivery_date }}
    {{ $plan->price }}
    {{ $plan->image_url }}
</div>
@endforeach
<div>
    {{ $validated_data['payment_way'] }}
    {{ $validated_data['first_name'] }}
    {{ $validated_data['last_name'] }}
    {{ $validated_data['first_name_kana'] }}
    {{ $validated_data['last_name_kana'] }}
    {{ $validated_data['email'] }}
    {{ $validated_data['gender'] }}
    {{ $validated_data['phone_number'] }}
    {{ $validated_data['postal_code'] }}
    {{ $validated_data['prefecture'] }}
    {{ $validated_data['city'] }}
    {{ $validated_data['block'] }}
    {{ $validated_data['building'] }}
    {{ $validated_data['birth_year'].$validated_data['birth_month'].$validated_data['birth_day'] }}
    {{ $validated_data['remarks'] }}
    {{ $validated_data['comments'] }}
</div>