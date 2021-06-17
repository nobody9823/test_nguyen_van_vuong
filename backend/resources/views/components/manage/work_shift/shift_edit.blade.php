{{--
    UI統一するためのコンポーネント 利用例
    :totals="$totals"                 <=> 合計勤怠時間
    guard='admin'                     <=> 認証ガードを指定
    :workShifts="$work_shifts"        <=> ワークシフト
    :targetMonth="$target_month"      <=> 対象月
--}}

<form name='work_shift_form'
    action={{ route("$guard.work_shift.update",($guard !== 'talent')? ['talent' => $workShifts->first()->talent]:null) }}
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
                    シフト入力<span style="font-size: 5px; color:grey;">(シフト、実績は承認済みのみ計算対象です。)</span><br>
                    <x-manage.work_shift.total_working_hours :totals=$totals />
                </th>
                <th style="width:10%">シフトコメント</th>
                <th style="width:10%">シフトステータス<br>最終更新者</th>
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
                    シフト :
                    {{ $work_shift->attendance_from ??'__ : __ ' }}~
                    {{ $work_shift->attendance_to ??'__ : __ ' }}
                    [{{ $work_shift->work_rest_minutes ??'---' }}分]
                    <x-manage.work_shift.display_status_banner :workShift="$work_shift" />
                    <br>
                    入力　 :
                    <input name='attendance_from[{{ $loop->iteration }}]' type="time"
                        value={{ old("attendance_from")?old("attendance_from")[$loop->iteration]:"" }}>
                    ~
                    <input name='attendance_to[{{ $loop->iteration }}]' type="time"
                        value={{ old("attendance_to")?old("attendance_to")[$loop->iteration]:"" }}>

                    休憩 :
                    <input min=0 max=300 name='work_rest_minutes[{{ $loop->iteration }}]'
                        value='{{ old("work_rest_minutes")?old("work_rest_minutes")[$loop->iteration]:"" }}'
                        type="number" step=1>分
                    <br>

                    実績　 :
                    {{ optional($work_shift->workAttendance)->attendance_from ??'__ : __ ' }}~
                    {{ optional($work_shift->workAttendance)->attendance_to ??'__ : __ ' }}
                    [{{ optional($work_shift->workAttendance)->work_rest_minutes ??'---' }}分]
                    <x-manage.work_shift.display_status_banner
                        :workAttendance="optional($work_shift->workAttendance)" />
                </td>
                <td>
                    @if (isset(old("comment")[$loop->iteration]))
                    <input name='comment[{{ $loop->iteration }}]' value='{{ old("comment")[$loop->iteration]}}'
                        type="text">
                    @else
                    <input name='comment[{{ $loop->iteration }}]' type="text">
                    @endif
                </td>

                <td>
                    <x-manage.work_shift.display_status :workShift="$work_shift" />
                    <br>
                    <x-manage.work_shift.display_last_updater :workShift="$work_shift" />
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
