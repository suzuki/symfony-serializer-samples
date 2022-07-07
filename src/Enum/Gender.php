<?php
declare(strict_types=1);

namespace App\Enum;

enum Gender: string
{
    case Unknown = 'unknown';
    case Male = 'male';
    case Female = 'female';
}
