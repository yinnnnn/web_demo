<template>
	<div class="report-self">
	  <div class="chunk-container">
	    <table class="table self-info">
	    	<tbody>
		    	<tr>
		    		<td class="col-xs-4"><span class="attr-name">姓名</span><span class="color-text-1">{{data.user_name}}</span></td>
		    		<td class="col-xs-4"><span class="attr-name">经纪号</span><span class="color-text-1">{{data.user_code}} </span></td>
		    		<td class="col-xs-4"><span class="attr-name">数据日期</span><span class="color-text-1">{{ isData && data.date_time.toDate('yyyy年MM月dd日')}}</span></td>
		    	</tr>
		    	<tr>
		    		<td class="col-xs-4"><span class="attr-name">部门</span><span class="color-text-1">{{data.dep_name}}</span></td>
		    		<td class="col-xs-4"><span class="attr-name">团队</span><span class="color-text-1">{{data.team_name}}</span></td>
		    		<td class="col-xs-4"></td>
		    	</tr>

		    	<tr>
		    		<td class="col-xs-4"><span class="attr-name">业务线</span><span class="color-text-1">{{data.org_business}}</span></td>
		    		<td class="col-xs-4"><span class="attr-name">总资产</span><span class="amount-add">{{isData && data.total_assets.toAmount(5)}}</span>万</td>
		    		<td class="col-xs-4"><span class="attr-name">资产180</span><span class="amount-add">{{isData && data.total_assets_180.toAmount(9)}}</span>亿</td>
		    	</tr>
		    </tbody>
	    </table>
	  </div>

  	<div class="chunk-container">
  		<div class="click-open color-text-2">
  			<input v-model="isShowOne" type="checkbox" /> 打开在同一时间只显示一个
  		</div>

	  	<div class="chunk-container--title">
	  		<div class="left-container">
	  			<div class="top-border"></div>
	  			<button class="btn-open" @click="openTable(0)">新增业绩</button>
		  		<!-- <a @click="openTable(0)" href="javascript:void(0)">新增业绩</a> -->
		  	</div>
	  		<!-- <a @click="openTable(0)" href="javascript:void(0)">新增业绩</a> -->
	  	</div>

	    <table :style="{display: openList[0] ? '': 'none' }" class="table">
	    	<thead>
	    		<tr>
		    		<th class="col-xs-1">统计口径</th>
		    		<th class="col-xs-1">新开户</th>
		    		<th class="col-xs-1">有效户</th>
		    		<th class="col-xs-1">两融</th>
		    		<th class="col-xs-1">港股通</th>
		    		<th class="col-xs-1">股票期权</th>
		    		<th class="col-xs-1">现金管理</th>
		    		<th class="col-xs-1">新增市值</th>
		    		<th class="col-xs-1">二次开发</th>
		    		<th class="col-xs-1">产品销售</th>
		    		<th class="col-xs-2">新增市值100万以上</th>
	    		</tr>
	    	</thead>

	    	<tbody>
	    		<tr>
	    			<td>当日</td>
	    			<td>{{data.d_new_account}}</td>
	    			<td>{{data.d_accept_account}}</td>
	    			<td>{{data.d_financing}}</td>
	    			<td>{{data.d_hk_stock}}</td>
	    			<td>{{data.d_stock_option}}</td>
	    			<td>{{data.d_cash_management}}</td>
	    			<td>{{data.d_new_marketvalue}}</td>
	    			<td>{{data.d_second_development}}</td>
	    			<td>{{data.d_product_sale}}</td>
	    			<td>{{data.d_marketvalue_100w}}</td>
	    		</tr>
	    		<tr>
	    			<td>当季</td>
						<td>{{data.q_new_account}}</td>
	    			<td>{{data.q_accept_account}}</td>
	    			<td>{{data.q_financing}}</td>
	    			<td>{{data.q_hk_stock}}</td>
	    			<td>{{data.q_stock_option}}</td>
	    			<td>{{data.q_cash_management}}</td>
	    			<td>{{data.q_new_marketvalue}}</td>
	    			<td>{{data.q_second_development}}</td>
	    			<td>{{data.q_product_sale}}</td>
	    			<td>{{data.q_marketvalue_100w}}</td>
	    		</tr>
	    	</tbody>
	    </table>
    </div>

    <div class="chunk-container">
	  	<div class="chunk-container--title">
	  		<div class="left-container">
	  			<div class="top-border"></div>
	  			<button class="btn-open" @click="openTable(1)">当季佣金费率</button>
		  		<!-- <a @click="openTable(1)" href="javascript:void(0)">当季佣金费率</a> -->
		  	</div>
	  	</div>

	    <table :style="{display: openList[1] ? '': 'none' }" class="table">
	    	<thead>
	    		<tr>
		    		<th class="col-xs-2">普通成交量（万）</th>
		    		<th class="col-xs-2">普通佣金（万）</th>
		    		<th class="col-xs-2">普通费率</th>
		    		<th class="col-xs-2">两融成交量（万）</th>
		    		<th class="col-xs-2">两融佣金</th>
		    		<th class="col-xs-2">两融费率</th>
	    		</tr>
	    	</thead>

	    	<tbody>
	    		<tr>
	    			<td>{{isData && data.normal_trading_volume.toAmount(5)}}</td>
	    			<td>{{isData && data.normal_brokerage.toAmount(5)}}</td>
	    			<td>{{isData && data.normal_rate.toAmount()}}</td>
	    			<td>{{isData && data.financing_trading_volume.toAmount(5)}}</td>
	    			<td>{{isData && data.financing_brokerage.toAmount()}}</td>
	    			<td>{{isData && data.financing_rate.toAmount()}}</td>
	    		</tr>
	    	</tbody>
	    </table>
    </div>

    <div class="chunk-container">
	  	<div class="chunk-container--title">
	  		<div class="left-container">
	  			<div class="top-border"></div>
	  			<button class="btn-open" @click="openTable(2)">当季银证转账</button>
		  		<!-- <a @click="openTable(2)" href="javascript:void(0)">当季银证转账</a> -->
		  	</div>
	  	</div>
	    <table :style="{display: openList[2] ? '': 'none' }" class="table">
	    	<thead>
	    		<tr>
		    		<th class="col-xs-2">转入金额（万）</th>
		    		<th class="col-xs-2">转出金额（万）</th>
		    		<th class="col-xs-2">净流入（万）</th>
	    		</tr>
	    	</thead>

	    	<tbody>
	    		<tr>
	    			<td :class="[data.securities_rollin_money < 0 ? 'amount-sub' : 'amount-add']">{{isData && data.securities_rollin_money.toAmount(5)}}</td>
	    			<td :class="[data.securities_rollout_money < 0 ? 'amount-sub' : 'amount-add']">{{isData && data.securities_rollout_money.toAmount(5)}}</td>
	    			<td :class="[data.securities_differ_money < 0 ? 'amount-sub' : 'amount-add']">{{isData && data.securities_differ_money.toAmount(5)}}</td>
	    		</tr>
	    	</tbody>
	    </table>
    </div>

    <div class="chunk-container">
	  	<div class="chunk-container--title">
	  		<div class="left-container">
	  			<div class="top-border"></div>
		  		<!-- <a @click="openTable(3)" href="javascript:void(0)">融资融券</a> -->
		  		<button class="btn-open" @click="openTable(3)">融资融券</button>
		  	</div>
	  	</div>

	    <table :style="{display: openList[3] ? '': 'none' }" class="table">
	    	<thead>
	    		<tr>
		    		<th class="col-xs-2">合格数</th>
		    		<th class="col-xs-2">开通数</th>
		    		<th class="col-xs-2">激活数</th>
		    		<th class="col-xs-2">负债（万）</th>
		    		<th class="col-xs-2">覆盖率</th>
		    		<th class="col-xs-2"></th>
	    		</tr>
	    	</thead>

	    	<tbody>
	    		<tr>
	    			<td>{{data.financing_accept_num}}</td>
	    			<td>{{data.financing_create_num}}</td>
	    			<td>{{data.financing_activate_num}}</td>
	    			<td>{{isData && data.financing_loan.toAmount(5)}}</td>
	    			<td>{{isData && data.financing_percent.toAmount()}}</td>
	    			<td></td>
	    		</tr>
	    	</tbody>
	    </table>
    </div>

    <div class="chunk-container">
	  	<div class="chunk-container--title">
	  		<div class="left-container">
	  			<div class="top-border"></div>
		  		<!-- <a @click="openTable(4)" href="javascript:void(0)">小微通</a> -->
		  		<button class="btn-open" @click="openTable(4)">小微通</button>
		  	</div>
	  	</div>
	    <table :style="{display: openList[4] ? '': 'none' }" class="table">
	    	<thead>
	    		<tr>
		    		<th class="col-xs-2">合格数</th>
		    		<th class="col-xs-2">开通数</th>
		    		<th class="col-xs-2">激活数</th>
		    		<th class="col-xs-2">负债（万）</th>
		    		<th class="col-xs-2">覆盖率</th>
		    		<th class="col-xs-2"></th>
	    		</tr>
	    	</thead>

	    	<tbody>
	    		<tr>
	    			<td>{{data.xwt_accept_num}}</td>
	    			<td>{{data.xwt_create_num}}</td>
	    			<td>{{data.xwt_activate_num}}</td>
	    			<td>{{isData && data.xwt_loan.toAmount(5)}}</td>
	    			<td>{{isData && data.xwt_percent.toAmount()}}</td>
	    			<td></td>
	    		</tr>
	    	</tbody>
	    </table>
    </div>

    <div class="chunk-container">
	  	<div class="chunk-container--title">
	  		<div class="left-container">
	  			<div class="top-border"></div>
		  		<!-- <a @click="openTable(5)" href="javascript:void(0)">港股通</a> -->
		  		<button class="btn-open" @click="openTable(5)">港股通</button>

		  	</div>
	  	</div>
	    <table :style="{display: openList[5] ? '': 'none' }" class="table">
	    	<thead>
	    		<tr>
		    		<th class="col-xs-4">合格数</th>
		    		<th class="col-xs-4">开通数</th>
		    		<th class="col-xs-4">覆盖率</th>
	    		</tr>
	    	</thead>

	    	<tbody>
	    		<tr>
	    			<td>{{data.hkstock_accept_num}}</td>
	    			<td>{{data.hkstock_create_num}}</td>
	    			<td>{{isData && data.hkstock_percent.toAmount()}}</td>
	    		</tr>
	    	</tbody>
	    </table>
    </div>

    <div class="chunk-container">
    	<div class="chunk-container--title">
	  		<div class="left-container">
	  			<div class="top-border"></div>
		  		<!-- <a @click="openTable(6)" href="javascript:void(0)">股票期权</a> -->
		  		<button class="btn-open" @click="openTable(6)">股票期权</button>
		  	</div>
	  	</div>
	    <table :style="{display: openList[6] ? '': 'none' }" class="table">
	    	<thead>
	    		<tr>
		    		<th class="col-xs-4">合格数</th>
		    		<th class="col-xs-4">开通数</th>
		    		<th class="col-xs-4">覆盖率</th>
	    		</tr>
	    	</thead>

	    	<tbody>
	    		<tr>
	    			<td>{{data.stock_option_accept_num}}</td>
	    			<td>{{data.stock_option_create_num}}</td>
	    			<td>{{isData && data.stock_option_percent.toAmount()}}</td>
	    		</tr>
	    	</tbody>
	    </table>
    </div>

    <div class="chunk-container">

    	<div class="chunk-container--title">
	  		<div class="left-container">
	  			<div class="top-border"></div>
		  		<!-- <a @click="openTable(7)" href="javascript:void(0)">现金管理类</a> -->
		  		<button class="btn-open" @click="openTable(7)">现金管理类</button>
		  	</div>
	  	</div>
	    <table :style="{display: openList[7] ? '': 'none' }" class="table">
	    	<thead>
	    		<tr>
		    		<th class="col-xs-1">统计口径</th>
		    		<th class="col-xs-1">开通数</th>
		    		<th class="col-xs-1">现金增利</th>
		    		<th class="col-xs-1">债分</th>
		    		<th class="col-xs-1">合理财8</th>
		    		<th class="col-xs-1">合计</th>
		    		<th class="col-xs-1">合格数</th>
		    		<th class="col-xs-1">覆盖率</th>
	    		</tr>
	    	</thead>

	    	<tbody>
	    		<tr>
	    			<td>当日</td>
	    			<td>{{data.cash_management_create_num}}</td>
	    			<td>{{data.cash_profits_create_num}}</td>
	    			<td>{{data.cash_loan_create_num}}</td>
	    			<td>{{data.cash_golden8_create_num}}</td>
	    			<td>{{data.cash_golden8_create_num}}</td>
	    			<td>{{data.cash_management_accept_num}}</td>
	    			<td>{{isData && data.cash_management_percent.toAmount()}}</td>
	    		</tr>
	    	</tbody>
	    </table>
    </div>

  </div>
</template>

<script>
	import sendAjax from '../../js/common/request.js';
	export default {
		ready() {
			this.getPersonal();
		},
		data () {
			return  {
				isData: false,
				data: {
				},
				tab: 1,
				isShowOne: false,
				openList: [true, true, true, true, true, true, true, true ]
			}
		},
		watch: {
			'isShowOne' (newVal, oldVal) {
				let list = [];
				if (newVal) {
					list[0] = true;
					for (let i = 1; i < this.openList.length; i++) {
						list.push(false);
					}
				} else {
					for (let i = 0; i < this.openList.length; i++) {
						list.push(true);
					}
				}
				this.openList = list;
			}
		},
		methods: {
			openTable (index) {
				let list = [];
				if (this.isShowOne) {
					for (let i = 0; i < this.openList.length; i++) {
						list.push(false);
					}
					list[index] = true;
				} else  {
					for (let i = 0; i < this.openList.length; i++) {
						list.push(this.openList[i]);
					}
					list[index] = !list[index];
				}
				this.openList = list;
			},
			getPersonal () {
				let _this = this;
				let id = this.$route.query.pid || '';
				sendAjax({
					url: '/finc/perform/daily',
					data: {
						user_id: id,
					},
					type: 'GET',
					success (result) {
						switch (result.code) {
							case 0:
								_this.isData = true;
								_this.data = result.data;
								break;
						}
					}
				});
			}
		}
	}
</script>

<style>
	
</style>