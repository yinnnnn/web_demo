<?php


date_default_timezone_set('Asia/Shanghai');
$link = mysqli_connect('120.25.78.52:3306', 'vernon', 'vernon');
if (!$link) {
    die('Could not connect to MySQL: ' . mysql_error());
}

mysqli_select_db($link, "wechat");
mysqli_query($link,"set names utf8");

$sql = "select * from wechat.t_book ";
$result = mysqli_query($link, $sql);
$arr = [];
while ($row = mysqli_fetch_array($result)) {
	$arr[] = ["name"=>$row['book_name'],'url'=>$row['book_url'],'cover'=>$row['book_cover'],'price'=>$row['price']];
}
echo json_encode($arr);




