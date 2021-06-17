{{--
    注入例
    :totals="$totals" controllerから受け取ったtotal
--}}

シフト計 : {{ floor($totals['shift_attendance_minutes_total']/60) }}時間
{{ $totals['shift_attendance_minutes_total']%60 }}分 -
[休憩計 : {{ floor($totals['shift_work_rest_minutes_total']/60) }}時間
{{ $totals['shift_work_rest_minutes_total']%60 }}分] =
{{ floor((($totals['shift_attendance_minutes_total']) - ($totals['shift_work_rest_minutes_total']))/60)}}時間
{{ (($totals['shift_attendance_minutes_total']) - ($totals['shift_work_rest_minutes_total']))%60}}分
<br>
実績計 　: {{ floor($totals['achievement_attendance_minutes_total']/60) }}時間
{{ $totals['achievement_attendance_minutes_total']%60 }}分 -
[休憩計 : {{ floor($totals['achievement_work_rest_minutes_total']/60) }}時間
{{ $totals['achievement_work_rest_minutes_total']%60 }}分] =
{{ floor((($totals['achievement_attendance_minutes_total']) - ($totals['achievement_work_rest_minutes_total']))/60)}}時間
{{ (($totals['achievement_attendance_minutes_total']) - ($totals['achievement_work_rest_minutes_total']))%60}}分
