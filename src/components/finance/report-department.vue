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
	  		<completion-item :target="591" :name="'有效户'" :avg="89" :icon="'icon-1'" :ranking="1" :number="654" :rate="117" ></completion-item>
	  		<completion-item :target="591" :name="'新增市值'" :avg="89" :icon="'icon-2'" :ranking="1" :number="530" :rate="89" ></completion-item>
	  		<completion-item :target="591" :name="'产品销售'" :avg="89" :icon="'icon-3'" :ranking="1" :number="654" :rate="117" ></completion-item>
	  		<completion-item :target="591" :name="'两融'" :avg="89" :icon="'icon-4'" :ranking="1" :number="530" :rate="89" ></completion-item>
	  		<completion-item :target="591" :name="'现金管理'" :avg="89" :icon="'icon-5'" :ranking="1" :number="654" :rate="117" ></completion-item>
	  		<completion-item :target="591" :name="'股票期权'" :avg="89" :icon="'icon-6'" :ranking="1" :number="530" :rate="89" ></completion-item>
	  		<completion-item :target="591" :name="'港股通'" :avg="89" :icon="'icon-7'" :ranking="1" :number="654" :rate="117" ></completion-item>
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
		props: ['target', 'name', 'icon', 'avg', 'ranking', 'rate', 'number'],
		template: `<div class="item color-text-2">
				  			<div class="row info">
				  				<div class="col-xs-8 name">
				  					<span class="icon" :class="icon"></span>{{name}}
				  				</div>
				  			</div>
				  			<div class="row degree">
				  				<div class="col-xs-8 degree-bar">
				  					<div v-if="rate<100" class="progressbar">
					  					<progressbar :label="number + ' / ' + rate + '%'"" :now="80"></progressbar>
				  					</div>
				  					<div v-if="rate>100" class="progressbar exceed">
					  					<progressbar :label="target + ' / 100%' " :now="80"></progressbar>
					  					<progressbar :label="(number-target) + ' / ' + (rate-100) +'%'" :now="20" :class-name="'exceed'"></progressbar>
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
							type: 'vlink',
							typeValue: '/results/report/personal'
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
			completionItem,radioGroup,radioBtn,
			'custom-table': table,
		},
		methods: {
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
				let _this = this;
				sendAjax({
					url: '/finc/perform/user_list',
					type: 'GET',
					data: {
						type: 'team'
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
			}
		}
	}
</script>
<style>
	
</style>