<?php

namespace App\Services\Date;

use Carbon\Carbon;

class DateFormatService
{
    protected $today;
    protected $diff_date = null;

    public function __construct()
    {
        $this->today = Carbon::now();
    }

    /**
     * check argument date is past
     *
     * @param int $date
     *
     * @return boolean
     */
    public function checkDateIsPast($date)
    {
        $date = new Carbon($date);
        return $date->isPast();
    }

    /**
     * check argument date is feature
     *
     * @param int $date
     *
     * @return boolean
     */
    public function checkDateIsFuture($date)
    {
        $date = new Carbon($date);
        return $date->isFuture();
    }

    /**
     * get diff compare with today
     *
     * @param int $date
     *
     * @return string
     */
    public function getDiffCompareWithToday($date)
    {
        new Carbon($date);
        $diff = $this->today->diffInMinutes($date);

        if ($diff <= 60) {
            return $this->today->diffInMinutes($date) . '分';
        } else if ($diff <= 1440) {
            return $this->today->diffInHours($date) . '時間';
        } else {
            return $this->today->diffInDays($date) . '日';
        }
    }

    /**
     * get payment term day
     *
     * @param int $project_end_date
     *
     * @return int
     */
    public function getPaymentTermDay($project_end_date)
    {
        new Carbon($project_end_date);
        $diff = $this->today->diffInDays($project_end_date);

        if ($diff >= 30) {
            return 30;
        } else {
            return $diff - 1;
        }
    }

    /**
     * format date for japanese
     *
     * @param $date
     *
     * @return mixed
     */
    public function forJapanese($date)
    {
        if ($date != null) {
            $date = Carbon::parse($date);
            return $date->format('Y年m月d日');
        }
    }
}
