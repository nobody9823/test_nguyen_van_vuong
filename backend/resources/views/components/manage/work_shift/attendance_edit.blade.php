{{--
    利用引数
    :totals="$totals"                 <=> 合計勤怠時間
    guard='admin'                     <=> 認証ガードを指定
    :workShifts="$work_shifts"        <=> ワークシフト
    :targetMonth="$target_month"      <=> 対象月
--}}

<form name='work_attendance_form'
    action={{ route("$guard.work_attendance.update",($guard !== 'talent')? ['talent' => $workShifts->first()->talent]:null) }}
    method="post">
    <input name='target_month' type='hidden' value="{{ $targetMonth->format('Y-m') }}">
    @csrf
    @method('put')
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th style="width:3%"><input name='checkbox' class="checkbox" type="checkbox"
                        {{ old('checkbox')?'checked':'' }} onchange="all_checkbox_toggle(this)"></th>
                <th style="width:12%">日付</th>
                <th style="width:30%">
                    実績入力<span style="font-size: 5px; color:grey;">(シフト、実績は承認済みのみ計算対象です。)</span><br>
                    <x-manage.work_shift.total_working_hours :totals=$totals />
                </th>
                <th style="width:10%">実績コメント</th>
                <th style="width:10%">実績ステータス<br>最終更新者</th>
            </tr>

            @foreach($workShifts as $work_shift)

            @if ($loop->iteration % 2 === 0)
            <tr>
                @else
            <tr style="background-color:rgb(243, 243, 243);">
                @endif
                <td>
                    {{-- 三項演算子重なるの嫌でif文 --}}
                    <input class="checkbox" type="checkbox" name="dates[{{ $loop->iteration }}]" @if (old("dates"))
                        {{ isset(old("dates")[$loop->iteration])?'checked':'' }} @endif value="{{ $work_shift->date }}">
                </td>

                <td>
                    <x-manage.work_shift.display_date :workShift="$work_shift" />
                </td>

                <td>
                    <div>
                        シフト:
                        {{ $work_shift->attendance_from ??'__ : __ ' }}~
                        {{ $work_shift->attendance_to ??'__ : __ ' }}
                        [{{ $work_shift->work_rest_minutes ??'---' }}分]

                        <x-manage.work_shift.display_status_banner :workShift="$work_shift" />
                    </div>
                    <div>
                        入力　:
                        @if (isset(old("attendance_from")[$loop->iteration]))
                        <input name='attendance_from[{{ $loop->iteration }}]' type="time"
                            value={{ old("attendance_from")[$loop->iteration] }}>
                        ~
                        <input name='attendance_to[{{ $loop->iteration }}]' type="time"
                            value={{ old("attendance_to")[$loop->iteration] }}>
                        @else
                        <input name='attendance_from[{{ $loop->iteration }}]' type="time"
                            value={{ optional($work_shift->workAttendance)->attendance_from }}>
                        ~
                        <input name='attendance_to[{{ $loop->iteration }}]' type="time"
                            value={{ optional($work_shift->workAttendance)->attendance_to }}>
                        @endif

                        &nbsp;休憩&nbsp;:
                        @if (isset(old("work_rest_minutes")[$loop->iteration]))
                        <input min=0 max=300 name='work_rest_minutes[{{ $loop->iteration }}]'
                            value='{{ old("work_rest_minutes")[$loop->iteration]}}' type="number" step=1>分
                        @else
                        <input min=0 max=300 name='work_rest_minutes[{{ $loop->iteration }}]'
                            value='{{ optional($work_shift->workAttendance)->work_rest_minutes}}' type="number" step=1>分
                        @endif

                    </div>

                </td>

                <td>
                    @if (isset(old("comment")[$loop->iteration]))
                    <input name='comment[{{ $loop->iteration }}]' value='{{ old("comment")[$loop->iteration]}}'
                        type="text">
                    @else
                    <input name='comment[{{ $loop->iteration }}]'
                        value='{{ optional($work_shift->workAttendance)->comment }}' type="text">
                    @endif
                </td>

                <td>
                    <x-manage.work_shift.display_status :workAttendance="optional($work_shift->workAttendance)" />
                    <br>
                    <x-manage.work_shift.display_last_updater :workAttendance="optional($work_shift->workAttendance)" />
                </td>

            </tr>
            @endforeach
        </table>
    </div>
</form>

<script>
    function all_checkbox_toggle(prop){
        this.checked = prop.checked;
        Array.from(document.getElementsByClassName('checkbox')).forEach(element => element.checked = this.checked);
    }

</script>
