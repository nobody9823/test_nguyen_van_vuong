<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RecruitmentStatus extends Enum
{
    const Default = '---';
    const Recruited =   '採用';
    const Rejected =   '不採用';
    const Screening = '選考中';
}
