<?php


date_default_timezone_set('Asia/Shanghai');
$link = mysqli_connect('120.25.78.52:3306', 'vernon', 'vernon');
if (!$link) {
	die('Could not connect to MySQL: ' . mysql_error());
}

mysqli_select_db($link, "wechat");
mysqli_query($link,"set names utf8");

$type = isset($_GET['type'])?($_GET['type']):0;

if ($type === 0){
	$sql = "SELECT spc,COUNT(1) cnt FROM t_6hc GROUP BY spc order by cnt desc ";
	$result = mysqli_query($link, $sql);
	$arr = [];
	while ($row = mysqli_fetch_array($result)) {
		$arr[] = ["spc"=>$row['spc'],'cnt'=>$row['cnt']];
	}
}
elseif ($type === 1) {
	$num = isset($_GET['num'])?intval($_GET['num']):0;
	$sql = "SELECT spc,qihao,`time`,inc FROM t_6hc where spc={$num} order by qihao asc";
	$result = mysqli_query($link, $sql);
	$arr = [];
	$pre['inc'] = 0;
	while ($row = mysqli_fetch_array($result)) {
		$arr[] = array_merge($row,['bt'=>$row['inc']-$pre['inc']]);
		$pre = $row;
	}
}
elseif ($type === 2) {
	$sql = "SELECT spc,COUNT(1) cnt FROM t_6hc where qihao>=2016000 GROUP BY spc order by cnt desc ";
	$result = mysqli_query($link, $sql);
	$arr = [];
	while ($row = mysqli_fetch_array($result)) {
		$arr[] = ["spc"=>$row['spc'],'cnt'=>$row['cnt']];
	}
}
// 出现次数
elseif ($type === 'oc_time') {
	$start = isset($_GET['start'])?intval($_GET['start']):0;
	$end = isset($_GET['end'])?intval($_GET['end']):0;
	$sql = "SELECT id spc,IFNULL(cnt,0) cnt FROM t_num a LEFT JOIN (SELECT spc,COUNT(1) cnt FROM t_6hc WHERE qihao>={$start}000 AND qihao<={$end}999 GROUP BY spc ORDER BY id DESC) b
	ON a.id=b.spc ORDER BY cnt desc";
	// echo $sql;
	$result = mysqli_query($link, $sql);
	$arr = [];
	while ($row = mysqli_fetch_array($result)) {
		$arr[] = ["spc"=>$row['spc'],'cnt'=>$row['cnt']];
	}
}
// 出现次数
elseif ($type === 'yilou') {
	$start = isset($_GET['start'])?intval($_GET['start']):0;
	$end = isset($_GET['end'])?intval($_GET['end']):0;
	$num = isset($_GET['num'])?intval($_GET['num']):0;
	$sql = "SELECT * FROM t_6hc WHERE qihao>={$start}000 AND qihao<={$end}999 and spc={$num} order by qihao desc";
	// echo $sql;
	$result = mysqli_query($link, $sql);
	$arr = [];
	while ($row = mysqli_fetch_array($result)) {
		$arr[] = $row;
	}
	$out = [];
	for($i=0;$i<count($arr)-1;$i++) {
		$out[] = ['spc'=>$arr[$i]['qihao'],'cnt'=>$arr[$i]['inc']-$arr[$i+1]['inc']];
	}
	$out[] = ['spc'=>$arr[$i]['qihao'],'cnt'=>0];
	$arr = array_reverse($out);
}


echo json_encode($arr);




