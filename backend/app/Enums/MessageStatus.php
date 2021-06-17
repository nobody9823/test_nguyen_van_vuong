<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MessageStatus extends Enum
{
    const Default = 'ステータスなし';
    const NewApplied = '新規購入';
    const Responded = '対応済';
    const No_Handle = '未対応';
}
