<?php
date_default_timezone_set('Asia/Shanghai');
$link = mysqli_connect('120.25.78.52:3306', 'vernon', 'vernon');
if (!$link) {
        die('Could not connect to MySQL: ' . mysql_error());
}

mysqli_select_db($link, "wechat");
mysqli_query($link,"set names utf8");

$sql = "INSERT INTO `statics`.`TableName1` (`page`,`ip`,`user_agent`)
	VALUES('index.php','{$_SERVER['REMOTE_ADDR']}','{$_SERVER['HTTP_USER_AGENT']}'); ";
$result = mysqli_query($link, $sql);

echo "Hello World";