<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MessageContributor extends Enum
{
    const supporter =   '支援者';
    const executor =   '実行者';
    const admin =   '管理者';
}
