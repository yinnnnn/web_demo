<?php

/* 
 * 输入：给定4个数字，如1,2,3,4
 * 输出: 最大的时间，23:41
 * 两种方案：
 * 1、排列组合，判断大小
 */

$arr=$_GET['num'];

for ($i = 0; $i < 4; $i++) {
	for ($j = $i; $j < 4; $j++) {
		$tmp = $arr[$i];
		$arr[$i] = $arr[$j];
		$arr[$j] = $tmp;
		echo "{$arr[0]},{$arr[1]},{$arr[2]},{$arr[3]}<br/>";
	}
}
exit;
/*
function max_time($arr){
	if($arr[0] == '2'){
		
	}
	$hour1=
}

function max_1($arr){
	if(has_2($arr)){
		
	}
}

function shift_2($arr){
	foreach ($arr as $v) {
		if($v == 2){
			return 
		}
	}
		
}
*/