<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('tj_array_sort_by_multi_cols')) {
    /**
     * 将一个二维数组按照多个列进行排序，类似 SQL 语句中的 ORDER BY
     *
     * 用法：
     * @code php
     * $rows = tj_array_sort_by_multi_cols($rows, array(
     *     'parent' => SORT_ASC,
     *     'name' => SORT_DESC,
     * ));
     * @endcode
     *
     * @param array $rowset 要排序的数组
     * @param array $args 排序的键
     *
     * @return array 排序后的数组
     */
    function tj_array_sort_by_multi_cols($rowset, $args) {
        $sortArray = array();
        $sortRule = '';
        $callParams = array();
        foreach ($args as $sortField => $sortDir)
        {
            foreach ($rowset as $offset => $row)
            {
                $sortArray[$sortField][$offset] = $row[$sortField];
            }
            if(!$sortArray) continue;
            $sortRule .= '$sortArray[\'' . $sortField . '\'], ' . $sortDir . ', ';
            $callParams = array_merge($callParams,array(
                $sortArray[$sortField],$sortDir,
            ));
        }
        if (empty($sortArray) || empty($sortRule)) { return $rowset; }
        //eval('array_multisort(' . $sortRule . '$rowset);');
        $callParams[] = &$rowset;
        call_user_func_array("array_multisort", $callParams);
        return $rowset;
    }
}

if (!function_exists('tj_array_sort_by_key')) {
    /**
     * 二维数组排序
     * @param $arrays           要排序的数组
     * @param $sort_key         排序的键
     * @param int $sort_order   SORT_ASC - 默认，按升序排列。(A-Z)
                                SORT_DESC - 按降序排列。(Z-A)
     * @param int $sort_type    SORT_REGULAR - 默认。将每一项按常规顺序排列。
                                SORT_NUMERIC - 将每一项按数字顺序排列。
                                SORT_STRING - 将每一项按字母顺序排列
     * @return array|bool
     */
    function tj_array_sort_by_key($arrays,$sort_key,$sort_order=SORT_ASC,$sort_type=SORT_NUMERIC) {
        if(is_array($arrays)){
            foreach ($arrays as $array){
                if(is_array($array)){
                    $key_arrays[] = $array[$sort_key];
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
        array_multisort($key_arrays,$sort_order,$sort_type,$arrays);
        return $arrays;
    }
}


if (!function_exists('tj_2arrays_find_array')) {
    /**
     * 从二维数组中根据key和value，查找对应的第二维数组
     * @param $arrays
     * @param $key
     * @param $value
     * @return mixed
     */
    function tj_2arrays_find_array($arrays, $key, $value) {
        if(is_array($value)) {
            foreach($value as $k=>$val) {
                $result[] = tj_2arrays_find_array($arrays, $key, $val);
            }
        } else {
            $key_array = array_column($arrays, $key);
            $arrays_key = array_search($value, $key_array);
            $result = $arrays_key !== FALSE ? $arrays[$arrays_key] : array();
        }
        return $result;
    }
}

if (!function_exists('tj_array_sort'))
{
    /**
     * 数组排序
     * @param array $arr 需要排序的数组
     * @param string $keys 排序的键名
     * @param string $type 排序的顺序
     * @return array
     */
    function tj_array_sort($arr, $keys, $type) {
        $keysvalue = array();
        
        foreach ($arr as $key => $val) {
            $val[$keys] = str_replace("-", "", $val[$keys]);
            $val[$keys] = str_replace(" ", "", $val[$keys]);
            $val[$keys] = str_replace(":", "", $val[$keys]);
            $keysvalue[] = $val[$keys];
        }
        asort($keysvalue); //key值排序
        reset($keysvalue); //指针重新指向数组第一个
        foreach ($keysvalue as $key => $vals) {
            $keysort[] = $key;
        }
        $new_array = array();
        if ($type != "asc") {
            for ($ii = count($keysort) - 1; $ii >= 0; $ii--) {
                $new_array[] = $arr[$keysort[$ii]];
            }
        } else {
            for ($ii = 0; $ii < count($keysort); $ii++) {
                $new_array[] = $arr[$keysort[$ii]];
            }
        }
        return $new_array;
    }
}

if (!function_exists('f_curl'))
{
    /**
     * 数组转换为字符
     * @param array $array 数组
     * @param int $level 深度
     * @return string
     */
    function f_curl($url, $header) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, 0);
			curl_setopt($ch, CURLOPT_ENCODING, "");  //不压缩
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			//	显示
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			return $data = curl_exec($ch);
    }
}

if (!function_exists('tj_obj2array'))
{
    /**
     * 多级对象转数据
     * @param obj $object 待转换的对象
     * @return array
     */
    function tj_obj2array($object=NULL) {
        $array = (array) $object;
        foreach ($array as $key => $val) {
            //判断是否为对象或数组，因为数组中可能还会存在对象
            if (is_object($val) || is_array($val)) {
                $val = tj_obj2array($val);
            }
            $array[$key] = $val;
        }
        return $array;
    }
}
