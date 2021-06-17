<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class WorkShiftLastUpdater extends Enum
{
    const Default = '---';
    const Talent = 'タレント';
    const Company = '企業';
    const Administer = '管理者';
}
