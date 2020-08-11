<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static NormalCalendar()
 * @method static static GoogleCalendar()
 * @method static static OptionThree()
 */
final class CalendarType extends Enum
{
    public const NormalCalendar =   0;
    public const GoogleCalendar =   1;
}
