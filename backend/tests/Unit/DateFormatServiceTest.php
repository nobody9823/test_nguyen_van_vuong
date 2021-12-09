<?php

namespace Tests\Unit;

use App\Services\Date\DateFormatFacade;
use Carbon\Carbon;
use Tests\TestCase;

class DateFormatServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCheckDateIsPastExpectTrue()
    {
        $now = Carbon::now();
        $date = $now->subDays(1);

        $response = DateFormatFacade::checkDateIsPast($date);

        $this->assertTrue($response);
    }

    public function testCheckDateIsPastExpectFalse()
    {
        $now = Carbon::now();
        $date = $now->addDays(1);

        $response = DateFormatFacade::checkDateIsPast($date);

        $this->assertFalse($response);
    }

    public function testCheckDateIsFutureExpectTrue()
    {
        $now = Carbon::now();
        $date = $now->addDays(1);

        $response = DateFormatFacade::checkDateIsFuture($date);

        $this->assertTrue($response);
    }

    public function testCheckDateIsFutureExpectFalse()
    {
        $now = Carbon::now();
        $date = $now->subDays(1);

        $response = DateFormatFacade::checkDateIsFuture($date);

        $this->assertFalse($response);
    }

    public function dataProviderFortestGetDiffCompareWithTodayExpect(): array
    {
        return [
            '60分を出力' => [60, '60分'],
            '24時間を出力' => [1440, '24時間'],
            '1日を出力' => [1441, '1日'],
        ];
    }

    /**
     * @dataProvider dataProviderFortestGetDiffCompareWithTodayExpect
     */
    public function testGetDiffCompareWithTodayExpect(int $minutes, string $left_time)
    {
        $now = Carbon::now();
        $date = $now->subMinute($minutes);
        $response = DateFormatFacade::getDiffCompareWithToday($date);

        $this->assertSame($left_time, $response);
    }

    public function testForJapanese()
    {
        $now = Carbon::now();
        $response = DateFormatFacade::forJapanese($now);
        $this->assertSame($now->format('Y年m月d日'), $response);
    }
}
