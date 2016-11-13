/*
1、js 如何循环
2、对象操作 

*/

function test(type,name,start,end,id='main',num=0){
	$.ajax({
		url: "http://120.25.78.52/vuejs/php/query_six.php?type="+type+"&start="+start+"&end="+end+"&num="+num,
		async:false,
		dataType: 'json',
		type: 'GET',
		success: function (res) { 	
			var x = new Array();
			var y = new Array();
			for(i = 0;i<res.length;i++){
				x.push(res[i].spc);
				y.push(res[i].cnt);
			}
			// 基于准备好的dom，初始化echarts实例
			var myChart = echarts.init(document.getElementById(id));


			// 指定图表的配置项和数据
			var option = {  
				title: {
					text: ''
				},
				tooltip: {},
				legend: {
					data:[name]
				},
				xAxis: {
					data: x
				},
				yAxis: {},
				series: [{
					name: name,
					type: 'bar',
					data: y,
					label:{
						normal:{
							show:true,
							position:'top',//设置显示数值
							textStyle:{
								color:'#000'
							}
						}
					},
					markLine : {
						precision:0,
						data : [
						{type : 'average', name: '平均值'}
						],
						lineStyle:{
							normal:{
								color:'violetred',
							}
						}
					},
					itemStyle:{
						normal:{
							color:'aquamarine',
						}
					}
				}]
			};

			// 使用刚指定的配置项和数据显示图表。
			myChart.setOption(option);	

			myChart.on('click', function (params) {

			});
		}
	});
}

var vm = new Vue({
	el: '#app',
	data: {
		num_list:[],
		year_list:[],
		sortKey:'qihao',
	},
	methods: {
		change1: function (ev) {

			var start = $('#start_year option:selected').val();//选中的值
			var end = $('#end_year option:selected').val();//选中的值
			console.log(start);
			test('oc_time',start+"-"+end,start,end,"bt_"+ev.currentTarget.id);
		},
		yilou: function (ev) {

			var start = $('#start_year option:selected').val();//选中的值
			var end = $('#end_year option:selected').val();//选中的值
			console.log(start);
			test('oc_time',start+"-"+end,start,end,"bt_"+ev.currentTarget.id);
		}
	},
	created: function () {
		var _self = this;
		for(i=1;i<=49;i++){
			_self.year_list.push(i);
		}
	},
	ready:function(){
		var type = 'yilou';
		var j=48;
		for(var i=1;i<=49;i++){
			test(type,i+"-"+i,1995,2016,"bt_view_"+j,i);
			j--;
		}
		test("yilou_sum","单个号码遗漏平均值",1995,2016,"bt_view",i);
	}
})
