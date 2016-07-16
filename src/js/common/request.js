/**
* ajax 请求发送，使用fetch，自动拼接request header公共参数
* author Gary Deng
**/

import md5 from 'md5';
//平台编号
const platCode = '100';
//版本号
const version = '1.0';
//权限请求接口域
const domainAuth = 'http://dev.authentication.guosen.com.cn';
//数据请求接口域
const domainData = 'http://dev.op.guosen.com.cn';
//请求纪录列表
const requestList = {};
/**
*	ajax 发送请求
* @opts {object} 请求参数 
*/
const getHeaderParams = () => {
	let time = parseInt((new Date().getTime())/1000);
	let params = {
		plat: platCode,
		ts: time,
		reqid: time,
		sign: '',
		device: `ver=${version}`,
		token: localStorage['token'] || '',
	}
	params.sign = md5(md5(params.plat + params.reqid + params.ts));
	return encodeURI(JSON.stringify(params));
}

const sendAjax = (opts) => {
	let rn = opts.name || opts.url;
	if (requestList[rn]) return;
	
	let defaultOpts = {
    url: '',
    type: 'POST',
    dataType: 'json',
    apiType: 'data',
    data: {},
  };
  let newOpts = Object.assign({}, defaultOpts, opts);
	newOpts.data.comm_params = getHeaderParams();
	let domain = '';
	switch(newOpts.apiType) {
		case 'auto':
			domain = domainAuth;
			break;
		default:
			domain = domainData;
			break;
	}
	requestList[rn] = true;
	console.log(domain + newOpts.url);
	console.log(newOpts);
	$.ajax({
		url: domain + newOpts.url,
		type: newOpts.type,
		dataType: newOpts.dataType,
		data: newOpts.data,
		success: function (res) {
			newOpts.success && newOpts.success(res);
		},
		error: function (error)  {
			newOpts.error && newOpts.error(error);
		},
		complete: function (request) {
			requestList[rn] = false;
			newOpts.complete && newOpts.complete(request);
		}
	});
	// fetch( domain + opts.url, {
	// 	method: 'POST',
	// 	headers: {
	// 		...getHeaderParams(),
	// 		'Accept': 'application/json',
	//     'Content-Type': 'application/json',
	// 	},
	// 	body: JSON.stringify(defaultOpts.data),
	// })
	// .then(checkStatus)
	// .then(parseJSON)
	// .then((result)=>{
	// 	requestList[rn] = false;
	// 	defaultOpts.callback && defaultOpts.callback(result);
	// }).catch((error)=>{
	// 	requestList[rn] = false;
	// 	defaultOpts.callback && defaultOpts.callback(error);
	// });
}


const checkStatus = (response) => {
	if (response.status >= 200 && response.status < 300) {
		return response;
	} else {
		let error = new Error(response.statusText);
    error.response = response;
    error.status = response.status;
    throw error
	}
}

const parseJSON = (response) => {
	return {
		status: response.status,
		data: response.json(),
	}
}

module.exports = sendAjax;