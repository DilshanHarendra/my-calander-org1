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
    const NormalCalendar =   0;
    const GoogleCalendar =   1;
}
