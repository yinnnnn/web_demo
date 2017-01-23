<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Zhihu extends CI_Controller {

	const CTABLE = 't_zhihu_collection';
	const QTABLE = 't_zhihu_question';

	public function __construct() {
		error_reporting(E_ALL);
		parent::__construct();
		$this->load->model('MTable');
		$this->load->helper('curl');
	}

	public function collect() {
		echo "hello world";
		exit;
		$header = array(
				'Host: api.zhihu.com
				Authorization: Bearer 2.0AAAAmMwYAAAAIIDp0jn4CQsAAABgAlVNrDWZWABpzxi-yYAahAUXaTaffKLDq3IWTw
				x-app-za: OS=iOS&Release=10.2&Model=iPhone7,2&VersionName=3.28.0&VersionCode=558&Width=640&Height=1136
				X-UDID: ACCA6dI5-AlLBSOXfE7biMOF4neRKYTuIiY=
				Accept-Encoding: gzip, deflate
				Accept-Language: zh-Hans-CN;q=1, ja-JP;q=0.9
				X-API-Version: 3.0.42
				Accept: */*
				User-Agent: osee2unifiedRelease/3.28.0 (iPhone; iOS 10.2; Scale/2.00)
				Connection: keep-alive
				X-APP-Build: release
				X-APP-VERSION: 3.28.0
				Cookie: aliyungf_tc=AQAAAB4vTBYQRwAAcWT6OmcJb9gTbGA+; d_c0=ACCA6dI5-AlLBSOXfE7biMOF4neRKYTuIiY=|1485139599; q_c0=2|1:0|10:1483843756|4:q_c0|92:Mi4wQUFBQW1Nd1lBQUFBSUlEcDBqbjRDUXNBQUFCZ0FsVk5yRFdaV0FCcHp4aS15WUFhaEFVWGFUYWZmS0xEcTNJV1R3|1be339759a77a7f03b182f1c8c0765bd0a568cb70b49081378806dc84944e69c; z_c0=Mi4wQUFBQW1Nd1lBQUFBSUlEcDBqbjRDUXNBQUFCZ0FsVk5yRFdaV0FCcHp4aS15WUFhaEFVWGFUYWZmS0xEcTNJV1R3|1484974249|da8e8180fe37bd09e3b9a684c27ff08b6b432ab5; q_c1=57b1733c176243b7b3ba8762dee2b06d|1484974234000|1484974234000; __utma=155987696.712140654.1484974234.1484974234.1484974234.1; __utmz=155987696.1484974234.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)
			');

		$url = 'https://api.zhihu.com/collections/19665726/contents?limit=20&offset=0';
		$suc = $fail = 0;
//		var_dump($url);
//		exit;
		do {
			$data = f_curl($url, $header);
//			echo $data;exit;
			$arr = json_decode($data, true);
//			var_dump($arr);
//			exit;
			echo $url . "<br/>";
//			continue;
			foreach ($arr['data'] as $row) {
				$r['type'] = $row['type'];
				$r['excerpt'] = $row['excerpt'];
				$r['collect_time'] = date("Y-m-d H:i:s", $row['collect_time']);
				if ($row['type'] == 'article') {
					$r['url'] = "https://zhuanlan.zhihu.com/p/{$row['id']}";
					$r['created_time'] = date("Y-m-d H:i:s", $row['created']);
					$r['title'] = $row['title'];
				} elseif ($row['type'] == 'answer') {
					$r['url'] = "https://www.zhihu.com/question/{$row['question']['id']}/answer/{$row['id']}";
					$r['created_time'] = date("Y-m-d H:i:s", $row['created_time']);
					$r['title'] = $row['question']['title'];
				}
//				$r['url']=$url;

				$ret = $this->MTable->insert(self::CTABLE, $r);
				$ret == true ? $suc++ : $fail++;
//				var_dump($ret);
//				exit;
			}
			$url = $arr['paging']['next'];
		} while (!$arr['paging']['is_end']);

		var_dump($suc, $fail);
		exit;
	}

	public function show() {
		$list = $this->MTable->query(self::CTABLE);
//		var_dump($list);
//		exit;
		$this->load->view('list', ['list' => $list]);
	}
	
	public function question() {
		$header = array(
				'Host: api.zhihu.com
Authorization: Bearer 2.0AAAAmMwYAAAAIIDp0jn4CQsAAABgAlVNrDWZWABpzxi-yYAahAUXaTaffKLDq3IWTw
x-app-za: OS=iOS&Release=10.2&Model=iPhone7,2&VersionName=3.28.0&VersionCode=558&Width=640&Height=1136
X-UDID: ACCA6dI5-AlLBSOXfE7biMOF4neRKYTuIiY=
Accept-Encoding: gzip, deflate
Accept-Language: zh-Hans-CN;q=1, ja-JP;q=0.9
X-API-Version: 3.0.42
Accept: */*
User-Agent: osee2unifiedRelease/3.28.0 (iPhone; iOS 10.2; Scale/2.00)
Connection: keep-alive
X-APP-Build: release
X-APP-VERSION: 3.28.0
Cookie: aliyungf_tc=AQAAAB4vTBYQRwAAcWT6OmcJb9gTbGA+; d_c0=ACCA6dI5-AlLBSOXfE7biMOF4neRKYTuIiY=|1485139599; q_c0=2|1:0|10:1483843756|4:q_c0|92:Mi4wQUFBQW1Nd1lBQUFBSUlEcDBqbjRDUXNBQUFCZ0FsVk5yRFdaV0FCcHp4aS15WUFhaEFVWGFUYWZmS0xEcTNJV1R3|1be339759a77a7f03b182f1c8c0765bd0a568cb70b49081378806dc84944e69c; z_c0=Mi4wQUFBQW1Nd1lBQUFBSUlEcDBqbjRDUXNBQUFCZ0FsVk5yRFdaV0FCcHp4aS15WUFhaEFVWGFUYWZmS0xEcTNJV1R3|1484974249|da8e8180fe37bd09e3b9a684c27ff08b6b432ab5; q_c1=57b1733c176243b7b3ba8762dee2b06d|1484974234000|1484974234000; __utma=155987696.712140654.1484974234.1484974234.1484974234.1; __utmz=155987696.1484974234.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)
');

		$url = 'https://api.zhihu.com/people/5a722f88edaaa91722c3efe9a3f1f6d0/following_questions?limit=20&offset=0';
		$suc = $fail = 0;
//		var_dump($url);
//		exit;
		do {
			$data = f_curl($url, $header);
//			echo $data;exit;
			$arr = json_decode($data, true);
//			var_dump($arr);
//			exit;
			echo $url . "<br/>";
//			continue;
			foreach ($arr['data'] as $row) {
				$r['title'] = $row['title'];
				$r['url'] = $row['url'];
				$r['qid'] = $row['id'];
				$r['created_time'] = date("Y-m-d H:i:s", $row['created']);
				$r['answer_count'] = $row['answer_count'];

				$ret = $this->MTable->insert(self::QTABLE, $r);
				$ret == true ? $suc++ : $fail++;
//				var_dump($ret);
//				exit;
			}
			$url = $arr['paging']['next'];
		} while (!$arr['paging']['is_end']);

		var_dump($suc, $fail);
		exit;
	}

	public function showe() {
		$list = $this->MTable->query(self::QTABLE);
		$this->load->view('list', ['list' => $list]);
	}

}
