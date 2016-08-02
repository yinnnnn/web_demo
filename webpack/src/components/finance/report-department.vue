<template>

	<div class="report-department">
		<div class="chunk-container chunk-container__bg completion-degree">
	  	<div class="chunk-container--title">
	  		<div class="left-container">
	  			<div class="top-border"></div>
		  		<span>综合完成率与排名</span>
		  	</div>
	  	</div>
	  	<div class="completion-degree--content">
	  		<div class="row title">
	  			<div class="col-xs-8 bar-desc">
  					<span class="progress-bar"></span>
  					<span>目标内完成值</span>
  					<span class="progress-bar exceed"></span>
  					<span>超额完成值</span>
	  			</div>

	  			<div class="col-xs-1 text-align">目标值</div>
	  			<div class="col-xs-1 text-align">排名</div>
	  			<div class="col-xs-2 text-align">部门平均值</div>
	  		</div>
	  		<completion-item :target="tableDepartment.obj.basic.q_accept_account_tg" :name="'有效户'" :avg="tableDepartment.obj.basic.q_accept_account_avg" :icon="'icon-1'" :ranking="tableDepartment.obj.basic.q_accept_account_rank" :number="tableDepartment.obj.basic.q_accept_account" :rate="tableDepartment.obj.basic.q_accept_rate" ></completion-item>
	  		<completion-item :target="tableDepartment.obj.basic.q_new_marketvalue_tg" :name="'新增市值'" :avg="tableDepartment.obj.basic.q_new_marketvalue_avg" :icon="'icon-2'" :ranking="tableDepartment.obj.basic.q_new_marketvalue_rank" :number="tableDepartment.obj.basic.q_new_marketvalue" :rate="tableDepartment.obj.basic.q_new_marketvalue_rate" ></completion-item>
	  		<completion-item :target="tableDepartment.obj.basic.q_product_sale_tg" :name="'产品销售'" :avg="tableDepartment.obj.basic.q_product_sale_avg" :icon="'icon-3'" :ranking="tableDepartment.obj.basic.q_product_sale_rank" :number="tableDepartment.obj.basic.q_product_sale" :rate="tableDepartment.obj.basic.q_product_sale_rate" ></completion-item>
	  		<completion-item :target="tableDepartment.obj.basic.q_financing_tg" :name="'两融'" :avg="tableDepartment.obj.basic.q_financing_avg" :icon="'icon-4'" :ranking="tableDepartment.obj.basic.q_financing_rank" :number="tableDepartment.obj.basic.q_financing" :rate="tableDepartment.obj.basic.q_financing_rate" ></completion-item>
	  		<completion-item :target="tableDepartment.obj.basic.q_cash_management_tg" :name="'现金管理'" :avg="tableDepartment.obj.basic.q_cash_management_avg" :icon="'icon-5'" :ranking="tableDepartment.obj.basic.q_cash_management_rank" :number="tableDepartment.obj.basic.q_cash_management" :rate="tableDepartment.obj.basic.q_cash_management_rate" ></completion-item>
	  		<completion-item :target="tableDepartment.obj.basic.q_stock_option_tg" :name="'股票期权'" :avg="tableDepartment.obj.basic.q_stock_option_avg" :icon="'icon-6'" :ranking="tableDepartment.obj.basic.q_stock_option_rank" :number="tableDepartment.obj.basic.q_stock_option" :rate="tableDepartment.obj.basic.q_stock_option_rate" ></completion-item>
	  		<completion-item :target="tableDepartment.obj.basic.q_hk_stock_tg" :name="'港股通'" :avg="tableDepartment.obj.basic.q_hk_stock_avg" :icon="'icon-7'" :ranking="tableDepartment.obj.basic.q_hk_stock_rank" :number="tableDepartment.obj.basic.q_hk_stock" :rate="tableDepartment.obj.basic.q_hk_stock_rate" ></completion-item>
	  	</div>
	  </div>

	  <div class="chunk-container chunk-container__bg">
	  	<div class="chunk-container--title">
	  		<div class="left-container">
	  			<div class="top-border"></div>
		  		<span>团队和个人情况</span>
		  	</div>
	  	</div>
	  	<div class="table-options">
		  	<radio-group :value.sync="tableOption">
		  		<radio-btn value="team">团队</radio-btn>
				  <radio-btn value="personal">个人</radio-btn>
				</radio-group>
			</div>
	    
	    <div :style="{display: tableOption ==='personal'?'block':'none'}">
				<custom-table :head.sync="tableMember.head" :listdata.sync="tableMember.listdata"></custom-table>
			</div>

			<div :style="{display: tableOption ==='team'?'block':'none'}">
				<custom-table :head.sync="tableTeam.head" :listdata.sync="tableTeam.listdata"></custom-table>
			</div>
    </div>

	</div>

</template>
<script>
	import Vue from 'vue';
	import progressbar  from '../common/progressbar.vue';
	import table from '../common/table.vue';
	import sendAjax from '../../js/common/request.js';
	import { radioGroup, radioBtn } from 'vue-strap';

	let completionItem = Vue.extend({
		// name: 'completionItem',
		components: {
			progressbar
		},
		props: {
			name: {
				name: String,
				default: ''
			},
			target: {
				icon: Number,
				default: 0
			},
			icon: {
				type: String,
				default: 0
			},
			avg: {
				type: Number,
				default: 0
			},
			ranking: {
				type: Number,
				default: 0
			},
			rate: {
				type: Number,
				default: 0
			},
			number: {
				type: [Number,String],
				default: 0
			}
		},
		template: `<div class="item color-text-2">
				  			<div class="row info">
				  				<div class="col-xs-8 name">
				  					<span class="icon" :class="icon"></span>{{name}}
				  				</div>
				  			</div>
				  			<div class="row degree">
				  				<div class="col-xs-8 degree-bar">
				  					<div v-if="rate<=100" class="progressbar">
					  					<progressbar :label="number + ' / ' + rate + '%'"" :now="rate"></progressbar>
				  					</div>
				  					<div v-if="rate>100" class="progressbar exceed">
					  					<progressbar :label="target + ' / 100%' " :now="80"></progressbar>
					  					<progressbar :label="(parseInt(number)-target) + ' / ' + (rate.toAmount()-100) +'%'" :now="20" :class-name="'exceed'"></progressbar>
				  					</div>
				  				</div>
				  				<div class="col-xs-1 text-align">{{target}}</div>
				  				<div class="col-xs-1 text-align">{{ranking}}</div>
				  				<div class="col-xs-2 text-align">{{avg}}</div>
				  			</div>
				  		</div>`
	})

	export default {
		ready () {
			this.getTeamList();
			this.getDepartment();
		},
		data () {
			return {
				tableOption: 'team',
				tableTeam: {
					isGetData: false,
					head: [
						{
							text: '名称',
							name: 'name',
							type: 'callback',
							typeValue: this.toTeam
						},
						{
							text: '有效户',
							name: 'q_accept_account',
							filterType: 'sort',
						},
						{
							text: '新增市值',
							name: 'q_accept_account',
							filterType: 'sort',
						},
						{
							text: '产品销售',
							name: 'q_product_sale',
							filterType: 'sort',
						},
						{
							text: '两融',
							name: 'q_financing',
							filterType: 'sort',
						},
						{
							text: '现金管理',
							name: 'q_cash_management',
							filterType: 'sort',
						},
						{
							text: '股票期权',
							name: 'q_stock_option',
							filterType: 'sort',
						},
						{
							text: '港股通',
							name: 'q_hk_stock',
							filterType: 'sort',
						}
					],
					listdata: [],
				},
				tableMember: {
					isGetData: false,
					head: [
						{
							text: '姓名',
							name: 'name',
							type: 'callback',
							typeValue: this.toPersonal
						},
						{
							text: '有效户',
							name: 'q_accept_account',
							filterType: 'sort',
						},
						{
							text: '新增市值',
							name: 'q_accept_account',
							filterType: 'sort',
						},
						{
							text: '产品销售',
							name: 'q_product_sale',
							filterType: 'sort',
						},
						{
							text: '两融',
							name: 'q_financing',
							filterType: 'sort',
						},
						{
							text: '现金管理',
							name: 'q_cash_management',
							filterType: 'sort',
						},
						{
							text: '股票期权',
							name: 'q_stock_option',
							filterType: 'sort',
						},
						{
							text: '港股通',
							name: 'q_hk_stock',
							filterType: 'sort',
						}
					],
					listdata: [],
				},
				tableDepartment: {
					isGetData: false,
					obj: {
						basic: {},
						chart: []
					}
				}
			}
		},
		watch: {
			'tableOption' (newVal, oldVal) {
				switch (newVal) {
					case 'team':
						this.getTeamList();
						break;
					case 'personal':
						this.getTeamMember();
						break;
				}
			}
		},
		components:{
			completionItem,
			radioGroup,radioBtn,
			'custom-table': table,
		},
		methods: {
			toTeam (item) {
				let link = `/results/report/team?tn=${item.name}&tid=${item.id}`;
				let params = this.$route.query.toString('&');
				link = link + ( params ? '&' + params : params );
				if (!this.$route.query.dn || !this.$route.query.did) {
					link = link + '&dep=1'
				}
				this.$router.go(link);
			},
			toPersonal (item) {
				let link = `/results/report/personal?pid=${item.id}&pn=${item.name}`;
				let params = this.$route.query.toString('&');
				link = link + ( params ? '&' + params : params );
				if (!this.$route.query.dn || !this.$route.query.did) {
					link = link + '&dep=1'
				}
				this.$router.go(link);
			},
			getTeamList () {
				if (this.tableTeam.isGetData) return;
				let _this = this;
				sendAjax({
					url: '/finc/perform/team_list',
					type: 'GET',
					success (result) {
						switch (result.code) {
							case 0:
								_this.tableTeam.isGetData = true;
								_this.tableTeam.listdata = result.data.list;
								break;
						}
					}
				});
			},
			getTeamMember () {
				if (this.tableMember.isGetData) return;
				let id = this.$toute.query.tid || '';
				let _this = this;
				sendAjax({
					url: '/finc/perform/user_list',
					type: 'GET',
					data: {
						type: 'dep',
						id: id
					},
					success (result) {
						switch (result.code) {
							case 0:
								_this.tableMember.isGetData = true;
								_this.tableMember.listdata = result.data.list;
								break;
						}
					}
				});
			},

			getDepartment () {
				if (this.tableDepartment.isGetData) return;
				let _this = this;
				let id = this.$route.query.tid || '';
				sendAjax({
					url: '/finc/perform/department',
					type: 'GET',
					data: {
						id: id
					},
					success (result) {
						switch (result.code) {
							case 0:
								_this.tableDepartment.isGetData = true;
								_this.tableDepartment.obj.basic = result.data.basic;
								_this.tableDepartment.obj.chart = result.data.chart;
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