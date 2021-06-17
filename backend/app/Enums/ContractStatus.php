<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ContractStatus extends Enum
{
    const Default =   '---';
    const InContract =   '契約中';
    const Cancellation = '契約解除';
    const Negotiation = '引合中';
}
