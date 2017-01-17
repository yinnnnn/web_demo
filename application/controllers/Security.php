<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Security extends CI_Controller {

	public function index() {
		var_dump(crc32('1sdvfdvklervvsadvsad.,nvdviwfkasdassssssssssssssssssssssssssssssssssssssssssssssss'));
		var_dump(sha1('1sdvfdvklervvsadvsad.,nvdviwfkasdassssssssssssssssssssssssssssssssssssssssssssssss'));
		var_dump(md5('1sdvfdvklervvsadvsad.,nvdviwfkasdassssssssssssssssssssssssssssssssssssssssssssssss'));
		exit;
	}

}
