<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Owner()
 * @method static static User()
 */
final class AccountRoleType extends Enum
{
    public const Owner =   0;
    public const User =   1;
}
