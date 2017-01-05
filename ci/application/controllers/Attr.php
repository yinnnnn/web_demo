<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Attr extends CI_Controller {

	public function index() {
		$CI = & get_instance();
		// 第二个参数防止xss过滤
		$url = $CI->input->get ( 'url', TRUE );
		date_default_timezone_set('Asia/Shanghai');
		$link = mysqli_connect('120.25.78.52:3306', 'vernon', 'vernon');
		if (!$link) {
			die('Could not connect to MySQL: ' . mysql_error());
		}
//		var_dump(mysqli_real_escape_string($link,$url));
//		exit;

		mysqli_select_db($link, "wechat");
		mysqli_query($link, "set names utf8");

		$sql = "INSERT INTO `statics`.`t_attr` (`page`,`ip`,`user_agent`)
				VALUES('{$url}','{$_SERVER['REMOTE_ADDR']}','{$_SERVER['HTTP_USER_AGENT']}'); ";
		$result = mysqli_query($link, $sql);
	}

}
