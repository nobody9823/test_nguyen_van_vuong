{{-- workShiftまたはworkAttendanceを注入する --}}
{{-- workShiftが注入された場合 --}}

@if (isset($workShift))
@switch($workShift->last_updater)
@case('---')
{{ '---' }}
@break

@case('タレント')
{{ $workShift->talent->name }}
@break

@case('企業')
{{ $workShift->talent->company->name }}
@break

@case('管理者')
{{ 'ガーディアン管理者' }}
@break

@default
@endswitch
{{-- workShiftが注入された場合 --}}

{{-- workAttendanceが注入された場合 --}}
@elseif (isset($workAttendance))
@switch($workAttendance->last_updater)
@case('---')
{{ '---' }}
@break

@case('タレント')
{{ $workAttendance->workShift->talent->name }}
@break

@case('企業')
{{ $workAttendance->workShift->talent->company->name }}
@break

@case('管理者')
{{ 'ガーディアン管理者' }}
@break

@default
{{ '---' }}
@endswitch
@endif
{{-- workAttendanceが注入された場合 --}}
