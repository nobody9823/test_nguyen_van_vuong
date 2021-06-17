<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProjectReleaseStatus extends Enum
{
    const Default = "---";
    const Pending = "承認待ち";
    const Published = "掲載中";
    const UnderSuspension = "掲載停止中";
    const SendBack = "差し戻し";
}
