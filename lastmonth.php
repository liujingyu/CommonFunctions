<?php
date_default_timezone_set("UTC");
/**
 * 获取上个月的开始和结束
 *
 * @param int $ts 时间戳
 *
 * @return array 第一个元素为开始日期，第二个元素为结束日期
 * @author liujingyu
 */
function lastMonth($ts) {

    $ts = intval($ts);

    $oneMonthAgo = mktime(0, 0, 0, date('n', $ts) - 1, 1, date('Y', $ts));

    $year = date('Y', $oneMonthAgo);
    $month = date('n', $oneMonthAgo);

    return array(
        date('Y-m-1', strtotime($year . "-{$month}-1")),
        date('Y-m-t', strtotime($year . "-{$month}-1"))
    );
}
$beginToday =  mktime(0, 0, 0, date('m'), date('d'), date('Y'));
$period = lastMonth($beginToday);
print_r($period);
