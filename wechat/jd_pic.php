 <?php

include 'ganon.php';
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
	$arr[] = ["name"=>$row['book_name'],'url'=>$row['book_url']];
	$html = file_get_dom($row['book_url']);

	$pic = [];
	// $price = '';
	foreach ($html('span[class="big-price"]') as $element) {

		$price = ($element->getInnerText());
	}
	foreach ($html('span[class="small-price"]') as $element) {

		$price .= ($element->getInnerText());
	}
	
	$isql = "update t_book set `price`='{$price}' where id={$row['id']}";
// var_dump($isql);exit;
	if($result1 = mysqli_query($link, $isql) == false){
		echo $isql;exit;
	}else{
		echo "{$row['id']} succ";
	}
} 
exit;
//图片
include 'ganon.php';
date_default_timezone_set('Asia/Shanghai');
$link = mysqli_connect('120.25.78.52:3306', 'vernon', 'vernon');
if (!$link) {
	die('Could not connect to MySQL: ' . mysql_error());
}

mysqli_select_db($link, "wechat");
mysqli_query($link,"set names utf8");

$sql = "select * from wechat.t_book where id=44 ";
$result = mysqli_query($link, $sql);
$arr = [];
while ($row = mysqli_fetch_array($result)) {
	$arr[] = ["name"=>$row['book_name'],'url'=>$row['book_url']];
	$html = file_get_dom($row['book_url']);

	$pic = [];
	foreach ($html('img[class="J_ping"]') as $element) {

		$pic[] = 'http:'.trim($element->attributes['src']);
	}

	$spic = json_encode($pic);
	$isql = "update t_book set `pic`='{$spic}',`book_cover`='{$pic[0]}' where id={$row['id']}";
// var_dump($isql);exit;
	if($result1 = mysqli_query($link, $isql) == false){
		echo $isql;exit;
	}else{
		echo "{$row['id']} succ";
	}
} 
 ?>