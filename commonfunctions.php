<?php
/**
 * 本人常用函数总结
 *
 * @author liujingyu
 * @copyright liujingyu, 13 三月, 2014
 **/


/**
 * json转数组，支持多层嵌套json
 *
 * @param $str
 *
 * @return array
 *
 * @author liujingyu
 **/
function jsonToArray($str) {
    if (is_string($str)) {
        $str = json_decode($str, true);
    }
    $arr = array();
    foreach ($str as $k=>$v) {
        if (is_string($v)) {
            $arr[$k] = $this->jsonToArray($v);
        } else {
            $arr[$k] = $v;
        }
    }

    return $arr;
}

/**
 * 多维数组排序，根据二维数组中的某个项排序
 *
 * @param $multi_array 二位数组
 * @param $sort_key
 * @sort SORT_ASC
 *
 * @return array
 *
 * @author liujingyu
 **/
function multi_array_sort($multi_array, $sort_key, $sort=SORT_ASC) {
    if (is_array($multi_array)) {
        foreach ($multi_array as $row_array){
            if (is_array($row_array)) {
                $key_array[] = $row_array[$sort_key];
            } else {
                return false;
            }
        }
    } else {
        return false;
    }

    array_multisort($key_array, $sort, $multi_array);
    return $multi_array;
}

/**
 * 比较两个数组记录求差集
 *
 * @param $arr1
 * @param $arr2
 *
 * @return array
 * @author liujingyu
 **/
function two_array_diff($arr1, $arr2) {
    $result = array();
    foreach ($arr1 as $key=>$value) {
        if (!in_array($value, $arr2)) {
            $result[] = $value;
        }
    }
    return $result;
}

/**
 * 获取数组中含有$prefix键的元素组成的数组
 *
 * @param $arr 传递的所有支付方式
 * @param $prefix 前缀
 * @return array
 *
 * @author liujingyu
 **/
function getPrefixKeyFromArray($arr, $prefix = 'prefix') {
    $result = array();
    foreach ($arr as $k=>$v) {
        if (strpos($k, $prefix) !== false) {
            $result[$k] = $v;
        }
    }

    return $result;
}

/**
 * 二维数组去重
 *
 * @param $arr
 *
 * @return array
 *
 * @author liujingyu
 **/

/**
 *
 * $arr = array(
 *     array('s'=>1, 'name'=>'asdfa'),
 *     array('s'=>1, 'name'=>'asdfa'),
 *     array('s'=>1, 'name'=>'asdfa'),
 * );
 **/

function array_unique2d($arr) {
    $result = array();
    foreach ($arr as $key) {
        if (!in_array($key, $result)) {
            array_push($result, $key);
        }
    }

    return $result;
}

