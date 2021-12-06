@if($project)
    @if($project->target_number <= $project->payments_sum_price)
    <form action="{{ route('admin.payment.alter_sales') }}" method="POST" class="mr-4" id="alter_sales">
        @csrf
        <input name="project" type="hidden" value="{{ Request::get('project') }}" />
            @foreach($payments as $key => $payment)
                <input name="payments[]" type="hidden" value="{{ $payment->id }}" />
            @endforeach
        <button class="btn btn-success mb-4" onclick="alterSales()" type="button">
            実売上計上
        </button>
    </form>
    @endif
    <form action="{{ route('admin.payment.alter_cancel') }}" method="POST" id="alter_cancel">
        @csrf
        <input name="project" type="hidden" value="{{ Request::get('project') }}" />
            @foreach($payments as $key => $payment)
                <input name="payments[]" type="hidden" value="{{ $payment->id }}" />
            @endforeach
        <button class="btn btn-danger mb-4" onclick="alterCancel()" type="button">
            売上キャンセル
        </button>
    </form>
@endif

<script>
    function alterSales() {
        if (confirm('実売上計上を行うと確保していた与信枠は無くなってしまいます。本当に実売上計上してもよろしいでしょうか。')) {
            if (confirm('本当に実売上計上を行ってもよろしいでしょうか。')) {
                document.getElementById('alter_sales').submit();
            }
        }
    }

    function alterCancel() {
        if (confirm('売上キャンセルを行うと確保していた与信枠は無くなってしまいます。本当に売上キャンセルしてもよろしいでしょうか。')) {
            if (confirm('本当に売上キャンセルを行ってもよろしいでしょうか。')) {
                document.getElementById('alter_cancel').submit();
            }
        }
    }
</script>
