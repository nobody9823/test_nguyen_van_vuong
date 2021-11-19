<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProjectReleasePeriod extends Enum
{
    const BeforeSeeking = '掲載開始前';
    const Seeking = '掲載中';
    const AfterSeeking = '掲載終了後';
}
