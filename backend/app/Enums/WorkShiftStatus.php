<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class WorkShiftStatus extends Enum
{
    const Default = '---';
    const PreApply = '申請前';
    const Applying = '承認待ち';
    const Remand = '差し戻し';
    const Approved = '承認済み';
}
