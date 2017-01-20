<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Security extends CI_Controller {

	public function index() {
		$argv = @array_slice($_SERVER['argv'], 1);
		$times = isset($argv[2]) ? $argv[2] : '';
//		$str = file_get_contents('/alidata/www/default/web_demo/ci/application/controllers/Security.php');
		$str = '1234567890';
		do {
			echo "------".strlen($str)."\n";
			$start1 = self::microtime_float();
			for ($i = 0; $i < $times; $i++) {
				crc32($str);
			}
			$start2 = self::microtime_float();
			$crc32 = ($start2 - $start1);
			echo "loop {$times} times crc32 use {$crc32}s\n";
			for ($i = 0; $i < $times; $i++) {
				md5($str);
			}
			$start3 = self::microtime_float();
			$md5 = ($start3 - $start2);
			echo "loop {$times} times md5 use {$md5}s\n";
			for ($i = 0; $i < $times; $i++) {
				sha1($str);
			}
			$start4 = self::microtime_float();
			$sha1 = ($start4 - $start3);
			echo "loop {$times} times sha1 use {$sha1}s\n";
			$str .='1234567890';
			
		} while ($crc32 < $sha1);
		echo "strlen".strlen($str)."\n";
		echo "$str \n";
		exit;
	}

	static function microtime_float() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float) $usec + (float) $sec);
	}

}
