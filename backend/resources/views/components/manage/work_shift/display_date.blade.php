@php
use Carbon\CarbonImmutable;
@endphp
{{-- workShiftまたはworkAttendanceを注入するcomponent --}}

{{-- workShiftが注入された場合 --}}
@if (isset($workShift))
@switch($workShift)
@case(CarbonImmutable::createMidnightDate($workShift->date)->dayOfWeek === 0)
<span style="color:red">{{ $workShift->date }}(日)</span>
@break
@case(CarbonImmutable::createMidnightDate($workShift->date)->dayOfWeek === 1)
<span>{{ $workShift->date }}(月)</span>
@break
@case(CarbonImmutable::createMidnightDate($workShift->date)->dayOfWeek === 2)
<span>{{ $workShift->date }}(火)</span>
@break
@case(CarbonImmutable::createMidnightDate($workShift->date)->dayOfWeek === 3)
<span>{{ $workShift->date }}(水)</span>
@break
@case(CarbonImmutable::createMidnightDate($workShift->date)->dayOfWeek === 4)
<span>{{ $workShift->date }}(木)</span>
@break
@case(CarbonImmutable::createMidnightDate($workShift->date)->dayOfWeek === 5)
<span>{{ $workShift->date }}(金)</span>
@break
@case(CarbonImmutable::createMidnightDate($workShift->date)->dayOfWeek === 6)
<span style="color:blue">{{ $workShift->date }}(土)</span>
@break
@default
@endswitch
{{-- workShiftが注入された場合 --}}


{{-- workAttendanceが注入された場合 (現在利用なし)--}}

@elseif (isset($workAttendance))
@switch($workAttendance)
@case(CarbonImmutable::createMidnightDate($workAttendance->date)->dayOfWeek === 0)
<span style="color:red">{{ $workAttendance->date }}(日)</span>
@break
@case(CarbonImmutable::createMidnightDate($workAttendance->date)->dayOfWeek === 1)
<span>{{ $workAttendance->date }}(月)</span>
@break
@case(CarbonImmutable::createMidnightDate($workAttendance->date)->dayOfWeek === 2)
<span>{{ $workAttendance->date }}(火)</span>
@break
@case(CarbonImmutable::createMidnightDate($workAttendance->date)->dayOfWeek === 3)
<span>{{ $workAttendance->date }}(水)</span>
@break
@case(CarbonImmutable::createMidnightDate($workAttendance->date)->dayOfWeek === 4)
<span>{{ $workAttendance->date }}(木)</span>
@break
@case(CarbonImmutable::createMidnightDate($workAttendance->date)->dayOfWeek === 5)
<span>{{ $workAttendance->date }}(金)</span>
@break
@case(CarbonImmutable::createMidnightDate($workAttendance->date)->dayOfWeek === 6)
<span style="color:blue">{{ $workAttendance->date }}(土)</span>
@break
@default
@endswitch
@endif
{{-- workAttendanceが注入された場合 --}}
