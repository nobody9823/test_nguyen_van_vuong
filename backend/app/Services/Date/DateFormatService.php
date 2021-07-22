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

    public function getDiffCompareWithToday($date = null)
    {
        if ($date !== null){
            $this->diff_date = $this->today->diffInDays($date);
        }
        return $this->diff_date > 0 ? $this->diff_date : null;
    }

    public function forJapanese($date = null)
    {
        if ($date != null){
            $date = Carbon::parse($date);
            return $date->format('Y年m月d日');
        }
    }
}