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
    // guard名と一致させることにした
    const web =   '支援者';
    const talent =   'タレント';
    // const company =   'タレント';
    const admin =   '管理者';
}
