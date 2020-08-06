<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class FileType extends Enum
{
    const Image =   0;
    const PDF =   1;
    const Video =   2;
}
