<?php

namespace App\Macros;

use Carbon\Carbon;

class DateFormatting
{

    public function formatForUser()
    {
        return static function () {
            return self::this()->copy()->format('d/m/Y');
        };
    }
}