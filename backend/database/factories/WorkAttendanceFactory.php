<?php

namespace Database\Factories;

use App\Models\WorkAttendance;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class WorkAttendanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkAttendance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'work_shift_id' => random_int(1, 100),
            'attendance_from' =>  new Carbon(),
            'attendance_to' =>  new Carbon('+5 hours'),
            'work_rest_minutes' =>  random_int(10, 300),
            'comment' =>  Arr::random([
                '電車遅延で少し遅れました。',
                'よろしくお願い致します。',
            ]),
        ];
    }
}
