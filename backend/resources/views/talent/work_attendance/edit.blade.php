@php
use Carbon\CarbonImmutable;
@endphp
@extends('talent.layouts.base')

@section('title', '実績管理')

@section('content')
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">
        <div>
            実績管理({{ $target_month->format('Y年m月') }}分)
        </div>
        <div>
            <form class="mb-2 mt-2" action={{ route("talent.work_shift.edit") }}>
                <button class="btn btn-sm btn-outline-success" name='target_month' type='submit'
                    value="{{ $target_month }}">シフト管理へ</button>
            </form>
        </div>
    </div>
    <div class="text-right">
        <button type="submit" class="btn btn-outline-success" onclick="form_submit('work_attendance_form')">
            チェックした実績を上長に申請
        </button>
        <button type="submit" class="btn btn-success" onclick="form_submit_after_all_checked('work_attendance_form')">
            入力実績を全て上長に申請
        </button>
    </div>
</div>

<x-manage.work_shift.translate_month guard='talent' model='work_attendance' :targetMonth=$target_month />

<x-manage.work_shift.attendance_edit :totals="$totals" guard='talent' :workShifts="$work_shifts"
    :targetMonth="$target_month" />

<x-manage.work_shift.translate_month guard='talent' model='work_attendance' :targetMonth=$target_month />


@section('script')
<script>
    function form_submit(form_name){
        document.forms[form_name].submit();
    }

    function form_submit_after_all_checked(form_name){
        Array.from(document.getElementsByClassName('checkbox')).forEach(element => element.checked = true);
        document.forms[form_name].submit();
    }

</script>
@endsection
@endsection
