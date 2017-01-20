<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Attr extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('curl');
	}

	public function index() {
		header('Access-Control-Allow-Origin:*');
		$allow_header = 'X-ACCESS_TOKEN,Access-Control-Allow-Origin,Authorization,Origin,x-requested-with,Content-Type,Content-Range,Content-Disposition,Content-Description';
		header('Access-Control-Allow-Headers: ' . $allow_header);
		$this->load->model('MTable');
		$CI = & get_instance();
		// 第二个参数防止xss过滤
		$url = $CI->input->get('url', TRUE);
		$r['page'] = $url ? $url : '';
		$r['ip'] = $_SERVER['REMOTE_ADDR'];
		$r['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
		$cnt = 10;
		do {
			if ($r['city'] = $this->GetIpFrom($r['ip'])) {
				break;
			}
		} while ($cnt--);
		$this->MTable->insert('wechat.t_attr', $r);
	}

	/* 获取IP所在地地址函数 */

	function GetIpFrom($ip = '') {
		$ip_json = f_curl("http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip, '', 200);
		$ip_arr = json_decode($ip_json, 1); //JSON格式字符解码
		if ($ip_arr['code'] == 0) {
			$country = $ip_arr['data']['country']; //国家，如中国
			$area = $ip_arr['data']['area']; //地区，如华南
			$region = $ip_arr['data']['region']; //省区，如广东省
			$city = $ip_arr['data']['city']; //城市，如汕头市
			$isp = $ip_arr['data']['isp']; //运营商，如电信
			$addr = $country . $area . $region . $city . $isp;
			return $addr;
		} else {
			return false;
		}
	}

}
