<?php

namespace Database\Factories;

use App\Enums\WorkShiftLastUpdater;
use App\Enums\WorkShiftStatus;
use App\Models\WorkShift;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class WorkShiftFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkShift::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'talent_id' => random_int(1, 100),
            'scheduled_attendance_from' =>  new Carbon(),
            'scheduled_attendance_to' =>  new Carbon('+5 hours'),
            'scheduled_work_rest_minutes' =>  random_int(10, 300),
            'applying_attendance_from' =>  new Carbon(),
            'applying_attendance_to' =>  new Carbon('+5 hours'),
            'applying_work_rest_minutes' =>  random_int(10, 300),
            'comment' =>  Arr::random([
                'よろしくお願いいたします。',
                'こちら先日話した部分のシフトです。',
                '平日お休みいただく分多く働きます。',
            ]),
            'last_updater' =>  WorkShiftLastUpdater::getValues()[random_int(0, 2)],
            'status' =>  WorkShiftStatus::getValues()[random_int(0, 4)],
        ];
    }
}
