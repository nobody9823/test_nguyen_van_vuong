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
     * @param $date
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
     * @param $date
     *
     * @return boolean
     */
    public function checkDateIsFuture($date)
    {
        $date = new Carbon($date);
        return $date->isFuture();
    }

    /**
     * check argument date is within a day
     *
     * @param $date
     *
     * @return boolean
     */
    public function checkDateIsWithInADay($date)
    {
        $date = new Carbon($date);
        $diff = $this->today->diffInHours($date);
        return $diff <= 24;
    }

    /**
     * get diff compare with today
     *
     * @param $date
     *
     * @return number
     */
    public function getDiffCompareWithToday($date)
    {
        new Carbon($date);
        $diff = $this->today->diffInDays($date);

        return $diff;

        // NOTICE: 追加開発が決まったらこちらを適用させてください
        // NOTICE: 差分が24時間以内になると時間が出力されます。
        // return $diff === 0
        //     ? $this->today->diffInHours($date)
        //     : $diff;
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
