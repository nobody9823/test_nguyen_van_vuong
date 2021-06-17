<?php

namespace App\Http\Controllers\Talent;

use App\Http\Controllers\Controller;
use App\Models\Talent;
use App\Models\WorkShift;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WorkShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $target_month = new CarbonImmutable($request->target_month);
        $work_shifts = $this->createAndFindWorkShift($target_month);
        return view('talent.work_shift.index', [
            'work_shifts' => $work_shifts,
            'target_month' => $target_month,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkShift  $workShift
     * @return \Illuminate\Http\Response
     */
    public function show(WorkShift $workShift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkShift  $workShift
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $target_month = new CarbonImmutable($request->target_month);
        $work_shifts = $this->createAndFindWorkShift($target_month);
        $totals = $this->calculateHours($work_shifts);
        return view('talent.work_shift.edit', [
            'target_month' => $target_month,
            'work_shifts' => $work_shifts,
            'totals' => $totals,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkShift  $workShift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //ここの処理冗長過ぎるので変えたい
        if ($request->dates) {
            foreach ($request->dates as $key => $value) {
                //日付が同じシフトを持ってくる(毎回クエリ飛ばしたくなさある)
                $work_shift = Auth::user()->workShifts()->whereDate('date', $value)->first();

                //シフトがリクエストされていない場合、何もしない
                if ($request->attendance_from[$key] || $request->attendance_to[$key] || $request->work_rest_minutes[$key]) {
                    //ある場合、バリデーション
                    $validator = Validator::make(
                        ["attendance_from"=>$request->attendance_from[$key],"attendance_to"=>$request->attendance_to[$key],"work_rest_minutes"=>$request->work_rest_minutes[$key]],
                        [
                        'attendance_from' => 'required|before:attendance_to',
                        'attendance_to' => 'required',
                        'work_rest_minutes' => 'required|integer|max:300'],
                        [],
                        [
                        'attendance_from' => '出勤時刻',
                        'attendance_to' => '退勤時刻',
                        'work_rest_minutes' => '休憩時間']
                    );
                    if ($validator->fails()) {
                        return back()->withErrors($validator)->withInput();
                    }
                    $work_shift->attendance_from = $request->attendance_from[$key];
                    $work_shift->attendance_to = $request->attendance_to[$key];
                    $work_shift->work_rest_minutes = $request->work_rest_minutes[$key];
                    $work_shift->status = '承認待ち';
                    $work_shift->last_updater = 'タレント';
                    $work_shift->save();
                    session()->flash('flash_message', '申請、更新が完了しました。');
                }
                //コメントだけは別で保存可能に
                if ($request->comment[$key]) {
                    $work_shift->comment = $request->comment[$key];
                    $work_shift->last_updater = 'タレント';
                    $work_shift->save();
                    session()->flash('flash_message', '申請、更新が完了しました。');
                }
            }
            is_null(session("flash_message")) ? session()->flash('error', '申請、更新したい項目を入力してください'):"";
            return back()->withInput();
        } else {
            session()->flash('error', '申請したい項目にチェックを付けてください');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkShift  $workShift
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkShift $workShift)
    {
        //
    }

    public function createAndFindWorkShift($target_month)
    {
        $target_month = new CarbonImmutable($target_month);
        $day_count = $target_month->daysInMonth;
        $first_day = $target_month->firstOfMonth();

        $work_shifts = WorkShift::getWorkShiftByTalent($target_month);
        if ($work_shifts->isEmpty()) {
            for ($i=0 ;$i < $day_count ; $i++) {
                Auth::user()->workShifts()->save(new WorkShift([
                    'date' => new CarbonImmutable($first_day->addDays($i)),
                ]));
            }
            $work_shifts = WorkShift::getWorkShiftByTalent($target_month);
        }

        return $work_shifts;
    }

    //今後まとめます
    public function calculateHours($work_shifts)
    {
        $shift_attendance_minutes_total = collect();
        $achievement_attendance_minutes_total = collect();
        $shift_work_rest_minutes_total = collect();
        $achievement_work_rest_minutes_total = collect();
        foreach ($work_shifts as $work_shift) {
            if ($work_shift->status === '承認済み') {
                $shift_attendance_minutes_total->push((strtotime($work_shift->attendance_to) - strtotime($work_shift->attendance_from))/60);
                $shift_work_rest_minutes_total->push($work_shift->work_rest_minutes);
            }
            if (optional($work_shift->workAttendance)->status === '承認済み') {
                $achievement_attendance_minutes_total->push((strtotime(optional($work_shift->workAttendance)->attendance_to) - strtotime(optional($work_shift->workAttendance)->attendance_from))/60);
                $achievement_work_rest_minutes_total->push(optional($work_shift->workAttendance)->work_rest_minutes);
            }
        }
        $totals['shift_attendance_minutes_total'] = $shift_attendance_minutes_total->sum();
        $totals['achievement_attendance_minutes_total'] = $achievement_attendance_minutes_total->sum();
        $totals['shift_work_rest_minutes_total'] = $shift_work_rest_minutes_total->sum();
        $totals['achievement_work_rest_minutes_total'] = $achievement_work_rest_minutes_total->sum();
        return $totals;
    }
}
