<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static PersonalAccount()
 * @method static static BusinessAccount()
 */
final class AccountType extends Enum
{
    public const PersonalAccount =   0;
    public const BusinessAccount =   1;
}
