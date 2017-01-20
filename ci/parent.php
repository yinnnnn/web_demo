<?php

class claA {

	public function __construct() {
		echo "claA __construct";
	}
}

class claB extends claA {

	public function __construct() {
		echo "claB __construct";
		self::__construct();
	}
}


$a = new claB();