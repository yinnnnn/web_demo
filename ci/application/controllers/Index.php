<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin:*');
		$allow_header = 'X-ACCESS_TOKEN,Access-Control-Allow-Origin,Authorization,Origin,x-requested-with,Content-Type,Content-Range,Content-Disposition,Content-Description';
		header('Access-Control-Allow-Headers: ' . $allow_header);
	}

	public function index() {
		echo "hellor world";
	}

}
