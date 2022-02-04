<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class GMOCvsCode extends Enum
{
    const Undefined = '---';
    const Lawson = '10001';
    const FamilyMart = '10002';
    const MiniStop = '10005';
    const SeicoMart = '10008';
}
