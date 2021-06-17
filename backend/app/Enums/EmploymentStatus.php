<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class EmploymentStatus extends Enum
{
    const Default = '---';
    const Permanent = '社員';
    const Temporary = '契約社員';
    const SubContract = '業務契約';
    const PartTime = 'アルバイト';
    const Other = 'その他';
}
