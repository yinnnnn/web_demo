 <?php

 include 'ganon.php';
 $html = file_get_dom('http://item.m.jd.com/product/11383763.html');


 foreach ($html('img[class="J_ping"]') as $element) {
 	var_dump($element->attributes['src']);
 	
 }
 exit;
 foreach($html('div[id="slide"]') as $element) {
 	$firstChild = $element->firstChild();
 	var_dump($element->childCount());
 	for ($i = 0; $i < $element->childCount(); $i++) {

 		$li =  $element->getChild($i);
 		echo 'ss';var_dump($li->tag);
 	}
 }

 ?>