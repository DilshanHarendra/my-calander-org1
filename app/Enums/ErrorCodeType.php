<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static API_TOKEN_NOT_PROVIDED()
 * @method static static API_TOKEN_EXPIRED()
 * @method static static INVALID_API_TOKEN()
 */
final class ErrorCodeType extends Enum
{
    public const API_TOKEN_NOT_PROVIDED =   1001;
    public const API_TOKEN_EXPIRED =   1002;
    public const INVALID_API_TOKEN = 1003;
    public const INVALID_EMAIL_OR_PASSWORD = 1010;

}
