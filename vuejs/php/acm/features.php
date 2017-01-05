<?php

/*
 * 给定两个字符串：判断是否是左移动得到的
 * abcdef
 * bcdefa
 */

function compare($str1, $pos, $str2) {
	$cnt = strlen($str1);
	for ($i = 0; $i < $cnt; $i++) {
		$cur = $pos + $i;
		$cur = $cur >= $cnt ? ( $cur - $cnt) : $cur;
		if ($str1[$cur] !== $str2[$i]) {
			return false;
		}
	}
	return true;
}

/*
 * 时间复杂度：n^2
 */

function check_relation_foreach($str1, $str2) {
	if (strlen($str1) !== strlen($str2))
		return false;

	for ($i = 0; $i < strlen($str1); $i++) {
		if (compare($str1, $i, $str2)) {
			return true;
		}
	}
	return false;
}

/*
 * 时间复杂度：2n
 */

function check_relation_func2($str1, $str2) {
	if (strlen($str1) !== strlen($str2))
		return false;

	for ($i = 0; $i < strlen($str1); $i++) {
		if (compare($str1, $i, $str2)) {
			return true;
		}
	}
	return false;
}

function test_equal($str1, $str2) {
	$ret = check_relation_foreach($str1, $str2) ? "==" : "!=";
	echo "$str1 $ret $str2\n<br/>";
}

/* 
 * http://www.ruanyifeng.com/blog/2013/05/Knuth%E2%80%93Morris%E2%80%93Pratt_algorithm.html
 * http://www.ruanyifeng.com/blog/2013/05/boyer-moore_string_search_algorithm.html
 * 
 *   */
function SearchString($str, $pat) {
	$retVal = array();
	$M = strlen($pat);
	$N = strlen($str);
	$i = 0;
	$j = 0;
	$lps = array();

	ComputeLPSArray($pat, $M, $lps);

	while ($i < $N) {
		if ($pat[$j] == $str[$i]) {
			$j++;
			$i++;
		}

		if ($j == $M) {
			array_push($retVal, $i - $j);
			$j = $lps[$j - 1];
		} else if ($i < $N && $pat[$j] != $str[$i]) {
			if ($j != 0)
				$j = $lps[$j - 1];
			else
				$i = $i + 1;
		}
	}

	return $retVal;
}

function ComputeLPSArray($pat, $m, &$lps) {
	$len = 0;
	$i = 1;

	$lps[0] = 0;

	while ($i < $m) {
		if ($pat[$i] == $pat[$len]) {
			$len++;
			$lps[$i] = $len;
			$i++;
		} else {
			if ($len != 0) {
				$len = $lps[$len - 1];
			} else {
				$lps[$i] = 0;
				$i++;
			}
		}
	}
}

test_equal("abcdef", "abcdef");
test_equal("abcdef", "bcdefa");
test_equal("abcdef", "fbcdefa");
test_equal("abcdef", "fabcde");
