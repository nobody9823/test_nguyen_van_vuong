<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class GmoBankAccountType extends Enum
{
    const CurrentAccount = '1';
    const CheckingAccount = '2';
    const SavingAccount = '4';
}
