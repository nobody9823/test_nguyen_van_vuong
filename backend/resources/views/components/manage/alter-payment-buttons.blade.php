@if($project)
    @if($project->target_number <= $project->payments_sum_price)
    <form action="{{ route('admin.payment.alter_sales') }}" method="POST" class="mr-4">
        @csrf
        <input name="project" type="hidden" value="{{ Request::get('project') }}" />
            @foreach($payments as $key => $payment)
                <input name="payments[]" type="hidden" value="{{ $payment->id }}" />
            @endforeach
        <button class="btn btn-success mb-4" onclick="return confirm('実売上計上を行うと確保していた与信枠は無くなってしまいます。本当に実売上計上してもよろしいでしょうか。')" type="submit">
            実売上計上
        </button>
    </form>
    @endif
    <form action="{{ route('admin.payment.alter_cancel') }}" method="POST">
        @csrf
        <input name="project" type="hidden" value="{{ Request::get('project') }}" />
            @foreach($payments as $key => $payment)
                <input name="payments[]" type="hidden" value="{{ $payment->id }}" />
            @endforeach
        <button class="btn btn-danger mb-4" onclick="return confirm('売上キャンセルを行うと確保していた与信枠は無くなってしまいます。本当に売上キャンセルしてもよろしいでしょうか。')" type="submit">
            売上キャンセル
        </button>
    </form>
@endif
