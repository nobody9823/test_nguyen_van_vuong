{{-- workShiftまたはworkAttendanceを注入する --}}
{{-- workShiftが注入された場合 --}}
@if (isset($workShift))
@switch($workShift->status)
@case('---')
{{ $workShift->status }}
@break

@case('申請前')
<span style="color:blue">
    {{ $workShift->status }}
</span>
@break

@case('承認待ち')
<span style="color:blue">
    {{ $workShift->status }}
</span>
@break

@case('差し戻し')
<span style="color:red">
    {{ $workShift->status }}
</span>
@break

@case('承認済み')
{{ $workShift->status }}
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
<span style="color:blue">
    {{ $workAttendance->status }}
</span>
@break

@case('承認待ち')
<span style="color:blue">
    {{ $workAttendance->status }}
</span>
@break

@case('差し戻し')
<span style="color:red">
    {{ $workAttendance->status }}
</span>
@break

@case('承認済み')
{{ $workAttendance->status }}
@break
@default
{{ '---' }}

@endswitch

@endif
