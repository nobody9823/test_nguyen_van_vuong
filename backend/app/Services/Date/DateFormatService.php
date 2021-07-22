<?php
namespace App\Services\Date;

use Carbon\Carbon;

class DateFormatService {

    protected $today;

    protected $diff_date = null;

    public function __construct()
    {
        $this->today = Carbon::now();
    }

    /**
     * check argument date is before today
     *
     * @param $date
     *
     * @return boolean
     */
    protected function checkDateBeforeToday($date)
    {
        return $this->today->gt($date);
    }

    /**
     * check argument date is after today
     *
     * @param $date
     *
     * @return boolean
     */
    protected function checkDateAfterToday($date)
    {
        return $this->today->lt($date);
    }

    /**
     * get diff compare with today
     *
     * @param $date
     *
     * @return number
     */
    public function getDiffCompareWithToday($date = null)
    {
        if ($date !== null && $this->checkDateBeforeToday($date)){
            $this->diff_date = $this->today->diffInDays($date);
        } else if ($date !== null && $this->checkDateAfterToday($date)){
            $this->diff_date = - $this->today->diffInDays($date);
        }
        return $this->diff_date;
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
        if ($date != null){
            $date = Carbon::parse($date);
            return $date->format('Y年m月d日');
        }
    }
}