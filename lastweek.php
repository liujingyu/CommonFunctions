<?php
date_default_timezone_set("UTC");

/**
 * 获取上n周的开始和结束，每周从周一开始，周日结束日期
 * @param int $ts 时间戳
 * @param int $n 你懂的(前多少周)
 * @param string $format 默认为'%Y-%m-%d',比如"2012-12-18"
 * @return array 第一个元素为开始日期，第二个元素为结束日期
 */
function lastNWeek($ts, $n, $format = '%Y-%m-%d') {
    $ts = intval($ts);
    $n  = abs(intval($n));

    // 周一到周日分别为1-7
    $dayOfWeek = date('w', $ts);
    if (0 == $dayOfWeek) {
        $dayOfWeek = 7;
    }

    $lastNMonday = 7 * $n + $dayOfWeek - 1;
    $lastNSunday = 7 * ($n - 1) + $dayOfWeek;
    return array(
        strftime($format, strtotime("-{$lastNMonday} day", $ts)),
        strftime($format, strtotime("-{$lastNSunday} day", $ts))
    );
}

$beginToday =  mktime(0, 0, 0, date('m'), date('d'), date('Y'));
$week = lastNWeek($beginToday, 1, "%Y-%m-%d %H:%M:%S");
print_r($week);
