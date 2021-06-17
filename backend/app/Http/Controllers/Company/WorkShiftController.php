<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Talent;
use App\Models\WorkShift;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WorkShiftController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\WorkShift  $workShift
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(WorkShift $workShift)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkShift  $workShift
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Talent $talent)
    {
        $target_month = new CarbonImmutable($request->target_month);
        $work_shifts = $this->createAndFindWorkShift($talent, $target_month);
        $totals = $this->calculateHours($work_shifts);
        return view('company.work_shift.edit', [
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
    public function update(Request $request, Talent $talent)
    {
        //ここの処理冗長過ぎるので変えたい
        if ($request->dates) {
            foreach ($request->dates as $key => $value) {
                //日付が同じシフトを持ってくる(毎回クエリ飛ばしたくなさある)
                $work_shift = $talent->workShifts()->whereDate('date', $value)->first();
                switch ($request->status) {
                    case 'approved':
                        //全て承認ボタン時は承認待ちのみを対象とする
                        if (($request->all_checked === "true") && ($work_shift->status !== '承認待ち')) {
                            //continue 2はforeach自体を次のループへ飛ばす
                            continue 2;
                        } else {
                            $this->work_shift_update($request, $key, $work_shift, '承認済み');
                        }
                        break;

                    case 'remand':
                        //上記同様
                        if (($request->all_checked === "true") && ($work_shift->status !== '承認待ち')) {
                            continue 2;
                        } else {
                            $this->work_shift_update($request, $key, $work_shift, '差し戻し');
                        }
                        break;
                    default:
                        abort(403);
                        break;
                }
            }
            //flash_messageがない=承認できる項目がなかった
            if (session("flash_message")) {
                return back()->withInput();
            } else {
                session()->flash('error', '承認、差し戻し出来るチェック項目がありません。');
                return back()->withInput();
            }
        } else {
            //dateがない <=> 一つもチェックが存在していない
            session()->flash('error', '申請したい項目にチェックを付けてください');
            return back()->withInput();
        }
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\WorkShift  $workShift
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(WorkShift $workShift)
    // {
    //     //
    // }

    public function createAndFindWorkShift($talent, $target_month)
    {
        $target_month = new CarbonImmutable($target_month);
        $day_count = $target_month->daysInMonth;
        $first_day = $target_month->firstOfMonth();

        $work_shifts = WorkShift::getWorkShiftByCompany($talent, $target_month);
        if ($work_shifts->isEmpty()) {
            for ($i=0 ;$i < $day_count ; $i++) {
                $talent->workShifts()->save(new WorkShift([
                    'date' => new CarbonImmutable($first_day->addDays($i)),
                ]));
            }
            $work_shifts = WorkShift::getWorkShiftByCompany($talent, $target_month);
        }

        return $work_shifts;
    }

    public function formValidate($request, $key)
    {
        return Validator::make(
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
    }

    public function work_shift_update($request, $key, $work_shift, $status)
    {
        // 一つでもリクエストあったらステータス関係なく更新
        if ($request->attendance_from[$key] || $request->attendance_to[$key] ||$request->work_rest_minutes[$key] || $request->comment[$key]) {
            $request->attendance_from[$key]?$work_shift->attendance_from = $request->attendance_from[$key]:'';
            $request->attendance_to[$key]?$work_shift->attendance_to = $request->attendance_to[$key]:'';
            $request->work_rest_minutes[$key]?$work_shift->work_rest_minutes = $request->work_rest_minutes[$key]:'';
            $request->comment[$key]?$work_shift->comment = $request->comment[$key]:'';
            $work_shift->status = $status;
            $work_shift->last_updater = '企業';
            $work_shift->save();
            session()->flash('flash_message', '承認が完了しました。');
        // ない場合は更新のみ
        } else {
            $work_shift->status = $status;
            $work_shift->last_updater = '企業';
            $work_shift->save();
            session()->flash('flash_message', '承認が完了しました。');
        }
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
