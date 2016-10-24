<?php
include 'ganon.php';
$html = file_get_dom("http://item.m.jd.com/product/10875285.html");

	$pic = [];
	// $price = '';
	foreach ($html('span[class="big-price"]') as $element) {

		$price = ($element->getInnerText());
	}
	foreach ($html('span[class="small-price"]') as $element) {

		$price .= ($element->getInnerText());
	}
	var_dump($price);
	foreach ($html('img[class="J_ping"]') as $element) {

		$pic[] = 'http:'.trim($element->attributes['src']);
	}
	var_dump($pic);