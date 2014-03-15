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

/**
 * 删除网页中的js，css脚本
 *
 * @param $str
 *
 * @return String
 *
 * @author liujingyu
 **/
function delScript($str) {
    $pregfind = array("/<script.*>.*<\/script>/siU", '/on(mousewheel|mouseover|click|load|onload|submit|focus|blur)="[^"]*"/i');
    $pregreplace = array('', '');
    $string = preg_replace($pregfind, $pregreplace, $string);
    $string = preg_replace('/<style[^>]*?>(.*?)<\/style>/si', '', $string); //去除style

    return $string;
}

/**
 * 在$haystack中,匹配以$needle开头
 *
 * @param $haystack
 * @param needle
 *
 * @return bool
 *
 * @author liujingyu
 **/
function startsWith($haystack, $needle) {
    return !strncmp($haystack, $needle, strlen($needle));
}

/**
 * 在$haystack中,匹配以$needle结尾
 *
 * @param $haystack
 * @param needle
 *
 * @return bool
 *
 * @author liujingyu
 **/
function endsWith($haystack, $needle) {
    return Tool::startsWith(strrev($haystack), strrev($needle));
}

/**
 * 多空格变单空格
 *
 * @param $str
 *
 * @return String
 *
 * @author liujingyu
 **/
function MergeSpaces($str) {
    return  preg_replace("/\s(?=\s)/", "\\1", $str);
}

/**
 * 绝对路径的
 *
 * @param $baseurl
 * @param $relativeurl
 *
 * @return String
 *
 * @author liujingyu
 **/
function urlJoin($baseurl, $relativeurl) {
    $p1 = parse_url($baseurl);
    $p2 = parse_url($relativeurl);
    $r = array_merge($p1, $p2);
    $spc = array('query', 'fragment', 'path');
    foreach ($p1 as $k => $v) {
        if (!isset($p2[$k]) && in_array($k, $spc)) {
            unset($r[$k]);
        }
    }
    if (isset($r['path']) && !isset($p2['host'])) {
        if (strpos($relativeurl, '/') !== 0) {
            $path1 = explode('/', isset($p1['path']) ? $p1['path'] : '');
            $path2 = explode('/', isset($p2['path']) ? $p2['path'] : '');
            array_pop($path1);
            foreach ($path2 as $px) {
                switch ($px) {
                case '..':
                    array_pop($path1);
                    break;
                case '.':
                    # nothing
                    break;
                default:
                    $path1[] = $px;
                    break;
                }
            }
            $r['path'] = implode( '/', $path1);
        }
    }
    return (isset($r['scheme']) ? $r['scheme'] . '://' : 'http://').(isset($r['user']) ? $r['user'].(isset($r['pass']) ? ':'.$r['pass'] : '').'@' : '').$r['host'].(isset($r['port']) ? ':' . $r['port'] : '').'/'.ltrim((isset($r['path']) ? $r['path'] : ''), '/').(isset($r['query']) ? '?'.$r['query'] : '').(isset($r['fragment']) ? '#'.$r['fragment'] : '');
}

