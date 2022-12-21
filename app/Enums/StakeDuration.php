<?php

namespace App\Enums;

enum StakeDuration: int
{
    case IMMEDIATELY = 0;
    case NEXT_12_MONTHS = 1;
}
