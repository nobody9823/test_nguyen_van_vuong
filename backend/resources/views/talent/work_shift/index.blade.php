@php
use Carbon\CarbonImmutable;
@endphp
@extends('talent.layouts.base')

@section('title', '実績管理')

@section('content')
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">
        実績管理({{ $target_month->format('Y年m月') }}分)
    </div>
    <div class="text-right">
        <a href="{{ route( 'talent.work_shift.edit') }}" class="btn btn-outline-success">シフト管理画面へ</a>
    </div>
</div>
<form action={{ route('talent.work_shift.index') }}>
    <button name='target_month' type='submit' value="{{ $target_month->subMonth()->format('Y-m') }}">◀</button>
    <button name='target_month' type='submit' value="{{ CarbonImmutable::now()->format('Y-m') }}">今月</button>
    <button name='target_month' type='submit' value="{{ $target_month->addMonth()->format('Y-m') }}">▶</button>
</form>
<div class="card-body">
    <table class="table table-bordered">
        <tr>
            <th style="width:8%">日付</th>
            <th style="width:8%">シフト開始</th>
            <th style="width:8%">シフト終了</th>
            <th style="width:8%">シフト休憩時間(分)</th>
            <th style="width:8%">実働開始</th>
            <th style="width:8%">実働終了</th>
            <th style="width:8%">実働休憩時間(分)</th>
            <th style="width:10%">シフトコメント</th>
            <th style="width:10%">実働コメント</th>
        </tr>
        @foreach($work_shifts as $work_shift)

        @if ($loop->iteration % 2 === 0)
        <tr>
            @else
        <tr style="background-color:rgb(243, 243, 243);">
            @endif

            <td>
                {{-- ここなんか長いから後で直したい --}}
                @switch($work_shift)

                @case(CarbonImmutable::createMidnightDate($work_shift->date)->dayOfWeek === 0)
                <span style="color:red">{{ $work_shift->date }}(日)</span>
                @break
                @case(CarbonImmutable::createMidnightDate($work_shift->date)->dayOfWeek === 1)
                <span>{{ $work_shift->date }}(月)</span>
                @break
                @case(CarbonImmutable::createMidnightDate($work_shift->date)->dayOfWeek === 2)
                <span>{{ $work_shift->date }}(火)</span>
                @break
                @case(CarbonImmutable::createMidnightDate($work_shift->date)->dayOfWeek === 3)
                <span>{{ $work_shift->date }}(水)</span>
                @break
                @case(CarbonImmutable::createMidnightDate($work_shift->date)->dayOfWeek === 4)
                <span>{{ $work_shift->date }}(木)</span>
                @break
                @case(CarbonImmutable::createMidnightDate($work_shift->date)->dayOfWeek === 5)
                <span>{{ $work_shift->date }}(金)</span>
                @break
                @case(CarbonImmutable::createMidnightDate($work_shift->date)->dayOfWeek === 6)
                <span style="color:blue">{{ $work_shift->date }}(土)</span>
                @break
                @default

                @endswitch
                {{-- ここなんか長いから後で直したい --}}
            </td>
            <td>
                {{ $work_shift->scheduled_attendance_from ??'__ : __ ~ __ : __' }}
            </td>
            <td>
                {{ $work_shift->scheduled_attendance_to ??'__ : __ ~ __ : __' }}
            </td>
            <td>
                {{ $work_shift->scheduled_rest_minutes }}
            </td>
            <td>
                <input name='attendance_from' type="time"
                    value={{ old('attendance_from',optional($work_shift->workAttendance)->attendance_from) }}>
            </td>
            <td>
                <input name='attendance_to' type="time"
                    value={{ old('attendance_to',optional($work_shift->workAttendance)->attendance_to) }}>
            </td>
            <td>
                {{ optional($work_shift->workAttendance)->work_rest_minutes }}
            </td>
            <td>
                {{ $work_shift->comment }}
            </td>
            <td>
                {{ optional($work_shift->workAttendance)->comment }}
            </td>
        </tr>
        @endforeach
    </table>
</div>
<form action={{ route('talent.work_shift.index') }}>
    <button name='target_month' type='submit' value="{{ $target_month->subMonth()->format('Y-m') }}">◀</button>
    <button name='target_month' type='submit' value="{{ CarbonImmutable::now()->format('Y-m') }}">今月</button>
    <button name='target_month' type='submit' value="{{ $target_month->addMonth()->format('Y-m') }}">▶</button>
</form>

@section('script')
<script>
    $(function(){
    $(".btn-dell").click(function(){
    if(confirm("本当に削除しますか？")){
    //そのままsubmit（削除）
    }else{
    //cancel
    return false;
    }
    });
    });
</script>
@endsection
@endsection
