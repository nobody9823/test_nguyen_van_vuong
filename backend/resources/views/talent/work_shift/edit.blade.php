@php
use Carbon\CarbonImmutable;
@endphp
@extends('talent.layouts.base')

@section('title', 'シフト管理')

@section('content')
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">
        <div>
            シフト管理({{ $target_month->format('Y年m月') }}分)
        </div>
        <div>
            <form class="mb-2 mt-2" action={{ route("talent.work_attendance.edit") }}>
                <button class="btn btn-sm btn-outline-success" name='target_month' type='submit'
                    value="{{ $target_month }}">実績管理へ</button>
            </form>
        </div>
    </div>
    <div class="text-right">
        <button type="submit" class="btn btn-outline-success" onclick="form_submit('work_shift_form')">
            チェックした項目を上長に申請
        </button>
        <button type="submit" class="btn btn-success" onclick="form_submit_after_all_checked('work_shift_form')">
            入力項目を全て上長に申請
        </button>
    </div>
</div>

<x-manage.work_shift.translate_month guard='talent' model='work_shift' :targetMonth=$target_month />

<x-manage.work_shift.shift_edit :totals="$totals" guard='talent' :workShifts="$work_shifts"
    :targetMonth="$target_month" />

<x-manage.work_shift.translate_month guard='talent' model='work_shift' :targetMonth=$target_month />


<script>
    function form_submit(form_name){
        document.forms[form_name].submit();
    }

    function form_submit_after_all_checked(form_name){
        Array.from(document.getElementsByClassName('checkbox')).forEach(element => element.checked = true);
        document.forms[form_name].submit();
    }

</script>
