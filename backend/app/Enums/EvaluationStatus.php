<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class EvaluationStatus extends Enum
{
    const Default = '---';
    const A = 'A';
    const Aplus = 'A+';
    const B = 'B';
    const Bplus = 'B+';
    const C = 'C';
    const Cplus = 'C+';
    const Other = 'その他';
}
