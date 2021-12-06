<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class FundedType extends Enum
{
    const AllIn = 'AllIn';
    const AllOrNothing = 'AllOrNothing';
}
