<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Zhihu extends CI_Controller {
	
//	public function __construct()
//	{
////		self::__construct();
////		$this->load->model('MTable');
////		$this->load->helper('curl');
//	}

	public function index() {
		$this->load->model('MTable');
		$this->load->helper('curl');
		$header = array(
				'Host: api.zhihu.com',
				'Authorization: Bearer 2.0AAAAmMwYAAAAIIDp0jn4CQsAAABgAlVNIqBxWAD6uwlJn4qBUGqBRC0uioFvTDMKkg',
				'x-app-za: OS=iOS&Release=10.2&Model=iPhone7,2&VersionName=3.28.0&VersionCode=558&Width=640&Height=1136',
				'X-UDID: ACCA6dI5-AlLBSOXfE7biMOF4neRKYTuIiY=',
				'Accept-Encoding: gzip, deflate',
				'If-None-Match: W/"b3dcac327abd07254bab760baa6d421c2a37a398"',
				'X-API-Version: 3.0.42',
				'Accept-Language: zh-Hans-CN;q=1, ja-JP;q=0.9',
				'Accept: */*',
				'User-Agent: osee2unifiedRelease/3.28.0 (iPhone; iOS 10.2; Scale/2.00)',
				'Connection: keep-alive',
				'X-APP-Build: release',
				'X-APP-VERSION: 3.28.0',
				'Cookie: capsion_ticket="2|1:0|10:1481249541|14:capsion_ticket|44:OWI3MmVkZTkwNjAyNGUzMzhjNmMwZjJiNzkyMjU3MGU=|b9a6194bbe5c5d1623673a36828f0b3be37d5644289be51d3337b59ce385bf27"; d_c0=ACCA6dI5-AlLBSOXfE7biMOF4neRKYTuIiY=|1482840378; q_c0=2|1:0|10:1481249570|4:q_c0|92:Mi4wQUFBQW1Nd1lBQUFBSUlEcDBqbjRDUXNBQUFCZ0FsVk5JcUJ4V0FENnV3bEpuNHFCVUdxQlJDMHVpb0Z2VERNS2tn|77f32923931edd681fde6ae37233fa761e66a1b88bf8d690915c4c28e4a0c256; z_c0=Mi4wQUFBQW1Nd1lBQUFBSUlEcDBqbjRDUXNBQUFCZ0FsVk5JcUJ4V0FENnV3bEpuNHFCVUdxQlJDMHVpb0Z2VERNS2tn|1482379640|e3e4eee8a09f2dc25ed613dd3d79c6ff11abfa39'
		);

		$url = 'https://api.zhihu.com/collections/19665726/contents?limit=20&offset=0';
		$suc = $fail = 0;
		do {
			$data = f_curl($url, $header);
			$arr = json_decode($data, true);
			
			echo $url."<br/>";
//			continue;
			foreach ($arr['data'] as $row) {
				$r['type']=$row['type'] ;
				$r['excerpt']=$row['excerpt'] ;
				$r['collect_time']=$row['collect_time'] ;
				if ($row['type'] == 'article') {
					$r['url']="https://zhuanlan.zhihu.com/p/{$row['id']}";
					$r['created_time']=$row['created'] ;
					$r['title']=$row['title'] ;
				} elseif ($row['type'] == 'answer') {
					$r['url']="https://www.zhihu.com/question/{$row['question']['id']}/answer/{$row['id']}";
					$r['created_time']=$row['created_time'] ;
					$r['title']=$row['question']['title'] ;
				}
//				$r['url']=$url;
				$ret = $this->MTable->insert($r);
				$ret == true ? $suc++ : $fail++;
			}
			$url = $arr['paging']['next'];
		} while (!$arr['paging']['is_end']);
		
		 var_dump($suc,$fail);
		 exit;
	}
	
	public function query() {
		$this->load->model('MTable');
		$this->load->helper('curl');
		$list = $this->MTable->query();
//		var_dump($list);
//		exit;
		$this->load->view('list', ['list'=>$list]);
	}

}
