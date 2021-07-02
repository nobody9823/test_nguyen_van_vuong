<div>ありがとうございます！</div>
<div>{{ $supporter_count }}人目</div>
<div>{{ $total_amount }}円</div>
<div>{{ $project->title }}</div>
<div>{{ $payment->merchant_payment_id }}</div>
<a href="{{ route('user.project.support', ['project' => $project]) }}">プロジェクトサポーターになる</a>
