<?php

use JetBrains\PhpStorm\NoReturn;
$input = readline();;
$data = explode('/', $input);
$year = (int)ltrim($data[0], '0');
$month = (int)ltrim($data[1], '0');
$day = (int)ltrim($data[2], '0');


function calculator($year, $month, $day): float|int
{
    $days = 0;
    $monthC = 0;

    if ($month > 6) {
        $monthC = (12 - $month - 1);
        if ($monthC > 0) {
            $days += $monthC * 30;
        }
        if ($month != 12) {
            $days += 29;
        }
    } else if ($month <= 6) {
        $monthC = (6 - $month);
        $days += $monthC * 31;
        $days += 29;
        $days += (5 * 30);
    }

    if ($month == 12) {
        $days += 29 - $day;
    } else if ($month > 6) {
        $days += 30 - $day;
    } else {
        $days += 31 - $day;
    }
    return $days;
}

echo calculator($year, $month, $day) + 1;
#[NoReturn] function dd($var): void
{
    echo $var;
    exit();
}
