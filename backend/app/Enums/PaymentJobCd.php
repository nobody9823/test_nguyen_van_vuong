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
    const VOID = 'キャンセル(取消)';
    const RETURN = 'キャンセル(返品)';
    const RETURNX = 'キャンセル(月跨り返品)';
    const UNPROCESSED = '未決済(コンビニ決済)';
    const REQSUCCESS = '要求成功(コンビニ決済)';
    const PAYSUCCESS = '決済完了(コンビニ決済)';
    const EXPIRED = '期限切れ(コンビニ決済)';
    const CANCEL = '支払停止(コンビニ決済)';
}
