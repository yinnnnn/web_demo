<template>
	<div class="report-team">
		<div class="chunk-container chunk-container__bg">
	  	<div class="chunk-container--title">
	  		<div class="left-container">
	  			<div class="top-border"></div>
		  		<span>团队和个人情况</span>
		  	</div>
	  	</div>
	  	<div class="table-options">
		  	<radio-group :value.sync="tableOption">
				  <radio value="personal">个人</radio>
				  <radio value="team">团队</radio>
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
	import table from '.././common/table.vue';
	import sendAjax from '../../js/common/request.js';
	import { radioGroup, radioBtn } from 'vue-strap';

	export default {
		created () {
			this.getTeamMember()
		},
		data () {
			return {
				tableOption: 'personal',
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
		components: {
			'custom-table': table,
			'radio-group': radioGroup,
			'radio': radioBtn
		},

		methods:  {
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