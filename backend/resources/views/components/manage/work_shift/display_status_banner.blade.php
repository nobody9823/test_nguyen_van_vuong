{{--
    使用例
    :workShift = $work_shift
    :workAttendance = $work_Attendance

    workShiftまたはworkAttendanceを注入する
--}}

{{-- workShiftが注入された場合 --}}
@if (isset($workShift))
@switch($workShift->status)
@case('---')
{{ $workShift->status }}
@break

@case('申請前')
<span class="badge badge-primary">
    {{ $workShift->status }}
</span>
@break

@case('承認待ち')
<span class="badge badge-primary">
    {{ $workShift->status }}
</span>
@break

@case('差し戻し')
<span class="badge badge-danger">
    {{ $workShift->status }}
</span>
@break

@case('承認済み')
<span class="badge badge-success">
    {{ $workShift->status }}
</span>
@break
@default

@endswitch
{{-- workShiftが注入された場合 --}}


{{-- workAttendanceが注入された場合 --}}
@elseif (isset($workAttendance))
@switch($workAttendance->status)
@case('---')
{{ $workAttendance->status }}
@break

@case('申請前')
<span class="badge badge-primary">
    {{ $workAttendance->status }}
</span>
@break

@case('承認待ち')
<span class="badge badge-primary">
    {{ $workAttendance->status }}
</span>
@break

@case('差し戻し')
<span class="badge badge-danger">
    {{ $workAttendance->status }}
</span>
@break

@case('承認済み')
<span class="badge badge-success">
    {{ $workAttendance->status }}
</span>
@break
@default
{{ '---' }}

@endswitch

@endif
