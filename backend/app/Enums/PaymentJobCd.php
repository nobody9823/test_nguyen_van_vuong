<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static AUTH()
 * @method static SALES()
 * @method static CANCEL()
 */
final class PaymentJobCd extends Enum
{
    const DEFAULT = '---';
    const FAILED = '購入失敗';
    const AUTH = '仮売上';
    const SALES = '実売上';
    const VOID = 'キャンセル';
    const RETURN = 'キャンセル';
    const RETURNX = 'キャンセル';
}
