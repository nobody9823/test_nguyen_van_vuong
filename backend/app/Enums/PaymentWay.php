<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PaymentWay extends Enum
{
    const PayPay = 'PayPay';
    const PayJp = 'PayJp';
    const Stripe = 'Stripe';
}
