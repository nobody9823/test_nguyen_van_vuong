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
    public function testGetDiffCompareWithTodayExpect1()
    {
        $now = Carbon::now();
        $response = DateFormatFacade::getDiffCompareWithToday($now->subDays(1));

        $this->assertSame(1, $response);
    }

    public function testGetDiffCompareWithTodayExpectNullWhenArgumentIsNow()
    {
        $now = Carbon::now();
        $response = DateFormatFacade::getDiffCompareWithToday($now);

        $this->assertSame(0, $response);
    }

    public function testGetDiffCompareWithTodayExpectNullWhenArgumentIsTommorow()
    {
        $now = Carbon::now();
        $response = DateFormatFacade::getDiffCompareWithToday($now->addDays(1));

        $this->assertSame(-1, $response);
    }

    public function testForJapanese()
    {
        $now = Carbon::now();
        $response = DateFormatFacade::forJapanese($now);
        $this->assertSame($now->format('Y年m月d日'), $response);
    }
}
