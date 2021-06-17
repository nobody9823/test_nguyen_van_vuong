{{--
    利用引数例
    $guard        <=> 認証ガード名
    $model        <=> 操作モデル名(わかりにくくてごめんなさい 現状 work_shift,work_attendance のみ)
    $talent       <=> 対象タレント(company,admin時のみ必要)
    $rarget_month <=> 対象月
--}}

@php
use Carbon\CarbonImmutable;
@endphp
<form class="mb-2 mt-2" action={{ route("$guard.$model.edit",isset($talent)?['talent' => $talent]:null) }}>
    <button name='target_month' class="btn btn-sm btn-outline-dark" type='submit'
        value="{{ $targetMonth->subMonth()->format('Y-m') }}">◀</button>
    <button name='target_month' class="btn btn-sm btn-outline-dark" type='submit'
        value="{{ CarbonImmutable::now()->format('Y-m') }}">今月</button>
    <button name='target_month' class="btn btn-sm btn-outline-dark" type='submit'
        value="{{ $targetMonth->addMonth()->format('Y-m') }}">▶</button>
</form>
