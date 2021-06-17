<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ResignationStatus extends Enum
{
    const Default = '---';
    const InProcess =   '手続中';
    const Resigned = '済';
}
