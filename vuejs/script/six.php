 <?php

 include 'ganon.php';
 date_default_timezone_set('Asia/Shanghai');
 $link = mysqli_connect('120.25.78.52:3306', 'vernon', 'vernon');
 if (!$link) {
 	die('Could not connect to MySQL: ' . mysql_error());
 }

 mysqli_select_db($link, "wechat");
 mysqli_query($link,"set names utf8");

 for($j = 2016; $j<2017;$j++){

 	// echo "./6hc/{$i}.html";continue;
 	$html = file_get_dom("./6hc/{$j}.html");
 	error_reporting(E_ALL);

 	foreach ($html('table[class="history_numbers"]') as $element) {
 	// var_dump($element->childCount());
 		for ($i = 2; $i < $element->childCount(); $i++) {
 			$text =$element->getChild($i)->getInnerText();

 			$arr = explode('</td>', $text);
 		// var_dump($arr);
 			// continue;
 			// var_dump(size($arr));
 			if(count($arr) >2){
 				$qihao = str_replace(['<td>',' '], '', $arr[0]);
 				$qihao = explode('<br/>', $qihao);
 			// var_dump(intval($qihao));exit;
 				$qh=trim($qihao[0]);
 				$time=trim($qihao[1]);
 				$qihao = explode('-', $time);
 				$qihao[0]= $j;
 				$qh = intval($qihao[0].$qh);
 				preg_match_all('/\d+/', $arr[1],$number);
 				$number = $number[0];
 				preg_match_all('/\d+/', $arr[2],$spc);
 				$spc = $spc[0];
 				$sql = "
 				INSERT INTO `wechat`.`t_6hc` 
 				(`qihao`, 
 				`time`, 
 				`num1`, 
 				`num2`, 
 				`num3`, 
 				`num4`, 
 				`num5`, 
 				`num6`, 
 				`spc`
 				)
 				VALUES
 				('{$qh}', 
 				'{$time}', 
 				'{$number[1]}', 
 				'{$number[2]}', 
 				'{$number[3]}', 
 				'{$number[4]}', 
 				'{$number[5]}', 
 				'{$number[6]}', 
 				'{$spc[0]}'
 				);
 				";

 				if($result1 = mysqli_query($link, $sql) == false){
 					echo $sql;continue;
 				}else{
 					echo "1234234252345\n";
 				}
 			}
 		}

 	}
 	echo "$i\n";
 }
 echo "end";exit;
 foreach ($html('table[class="history_numbers"]') as $element) {
 	for ($i = 2; $i < $element->childCount(); $i++) {
 		$li = $element->getChild($i);
 		var_dump($li('td[class="numbre"]')->getInnerText());exit;
 		var_dump($li->getInnerText());
 	 		// exit;
 	}
 	
 }
 echo "end";




 ?>