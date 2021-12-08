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

    // public function testcheckDateIsWithInADayExpectTrue()
    // {
    //     $now = Carbon::now();
    //     $date = $now->subHours(12);

    //     $response = DateFormatFacade::checkDateIsWithInADay($date);

    //     $this->assertTrue($response);
    // }

    // public function testcheckDateIsWithInADayExpectFalse()
    // {
    //     $now = Carbon::now();
    //     $date = $now->subHours(30);

    //     $response = DateFormatFacade::checkDateIsWithInADay($date);

    //     $this->assertFalse($response);
    // }

    // public function testGetDiffCompareWithTodayExpect1()
    // {
    //     $now = Carbon::now();
    //     $date = $now->subDays(1);
    //     $response = DateFormatFacade::getDiffCompareWithToday($date);

    //     $this->assertSame(1, $response);
    // }

    // public function testGetDiffCompareWithTodayExpectNullWhenArgumentIsNow()
    // {
    //     $now = Carbon::now();
    //     $response = DateFormatFacade::getDiffCompareWithToday($now);

    //     $this->assertSame(0, $response);
    // }

    public function testForJapanese()
    {
        $now = Carbon::now();
        $response = DateFormatFacade::forJapanese($now);
        $this->assertSame($now->format('Y年m月d日'), $response);
    }
}
