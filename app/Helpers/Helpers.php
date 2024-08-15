<?php

namespace App\Helpers;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use DateTime;

class Helpers
{

    public static function removeSpecialCharacter($str = null)
    {
        $res = preg_replace('/[-\@\.\;\" "\/()]+/', '', $str);
        return $res;
    }

}
