@php
use Carbon\CarbonImmutable;
@endphp
@extends('company.layouts.base')

@section('title', 'シフト管理')

@section('content')
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">
        <div>
            シフト管理({{ $target_month->format('Y年m月') }}分) タレント名:{{ $work_shifts->first()->talent->name }}
        </div>
        <div>
            <form class="mb-2 mt-2"
                action={{ route("company.work_attendance.edit",['talent' => $work_shifts->first()->talent]) }}>
                <button class="btn btn-sm btn-outline-success" name='target_month' type='submit'
                    value="{{ $target_month }}">実績管理へ</button>
            </form>
        </div>
    </div>
    <div class="text-right">
        <button type="submit" class="btn btn-outline-success"
            onclick="form_submit_remand('work_shift_form','status','remand')">
            チェック項目を差し戻し
        </button>
        <button type="submit" class="btn btn-success"
            onclick="form_submit_remand_after_all_checked('work_shift_form','status','remand')">
            承認待ちを全て差し戻し
        </button>
        <button type="submit" class="btn btn-outline-success"
            onclick="form_submit_approved('work_shift_form','status','approved')">
            チェック項目を承認
        </button>
        <button type="submit" class="btn btn-success"
            onclick="form_submit_approved_after_all_checked('work_shift_form','status','approved')">
            承認待ちを全て承認
        </button>
    </div>
</div>

<x-manage.work_shift.translate_month guard='company' model='work_shift' :talent="$work_shifts->first()->talent"
    :targetMonth="$target_month" />

<x-manage.work_shift.shift_edit :totals="$totals" guard='company' :workShifts="$work_shifts"
    :targetMonth="$target_month" />

<x-manage.work_shift.translate_month guard='company' model='work_shift' :talent="$work_shifts->first()->talent"
    :targetMonth="$target_month" />

@section('script')
<script>
    function add_hidden(form_name,name,value){
        var target_form = document.createElement('input');
            target_form.type = 'hidden';
            target_form.name = name;
            target_form.value = value;
            if (form_name) {
                document.forms[form_name].appendChild(target_form);
                document.forms[form_name].submit();
            } else {
                document.forms[0].appendChild(target_form);
            }
    }

    function form_submit_approved(form_name,name,value){
        if(confirm('状況に関係なく、チェックしたものは全て"承認済み"になります。よろしいでしょうか？')){
            add_hidden(form_name,name,value);
            add_hidden(form_name,'all_checked',false);
            document.forms[form_name].submit();
        }
    }

    function form_submit_remand(form_name,name,value){
        if(confirm('状況に関係なく、チェックしたものは全て"差し戻し"になります。よろしいでしょうか？')){
            add_hidden(form_name,name,value);
            add_hidden(form_name,'all_checked',false);
            document.forms[form_name].submit();
        }
    }


    function form_submit_approved_after_all_checked(form_name,name,value){
        add_hidden(form_name,name,value);
        Array.from(document.getElementsByClassName('checkbox')).forEach(element => element.checked = true);
        add_hidden(form_name,'all_checked',true);
        document.forms[form_name].submit();
    }

    function form_submit_remand_after_all_checked(form_name,name,value){
        add_hidden(form_name,name,value);
        Array.from(document.getElementsByClassName('checkbox')).forEach(element => element.checked = true);
        add_hidden(form_name,'all_checked',true);
        document.forms[form_name].submit();
    }

</script>
@endsection
@endsection
