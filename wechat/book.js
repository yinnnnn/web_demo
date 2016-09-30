/*
$(document).ready(function(){

  htmlobj=$.ajax({url:"/wechat/autoresponse.php",async:false});
  $("#myDiv").html(htmlobj.responseText);
 
});
*/


var vm = new Vue({
	el: '#app',
	data: {
		book_list:[{'name':"xxx",'url':"baidu.com"}]
	},
	methods: {
		change1: function (type) {
			console.log(type);
			var _self = this;
		$.ajax({
			url: "http://120.25.78.52/wechat/autoresponse.php?type="+type,
			async:false,
			dataType: 'json',
			type: 'GET',
			success: function (res) {
				_self.book_list = res; 
			}
		});
		}
	},
	created: function () {
		var _self = this;
		// $.ajax({
		// 	url: "http://120.25.78.52/wechat/autoresponse.php",
		// 	async:false,
		// 	dataType: 'json',
		// 	type: 'GET',
		// 	success: function (res) {
		// 		_self.book_list = res; 
		// 	}
		// });
	}
})
