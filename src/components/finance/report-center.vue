<template>
	<div class="report-center">
		<div class="chunk-container">
			<custom-table :head="tableDep.head" :listdata="tableDep.listdata"></custom-table>
		</div>
	</div>
</template>
<script>
	import sendAjax from '../../js/common/request.js';
	import table from '.././common/table.vue';
	export default {
		created () {
			this.getDepList();
		},
		data () {
			return {
				tableDep: {
					head: [
						{
							text: '部门',
							name: 'name',
							type: 'vlink',
							typeValue: '/results/report/department'					
						},
						{
							text: '排名',
							name: 'final_complete_rank',
							filterType: 'sort',
						},
						{
							text: '综合完成率',
							name: 'final_complete_rate',
							filterType: 'sort',
							class:'col-xs-1 th-overall'
						},
						{
							text: '有效户',
							name: 'q_accept_account',
							filterType: 'sort',
						},
						{
							text: '新增市值',
							name: 'q_new_marketvalue',
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
			}
		},
		components: {
			'custom-table': table,
		},
		methods: {
			getDepList () {
				let _this = this;
				sendAjax({
					url: '/finc/perform/center',
					type: 'GET',
					success (result) {
						switch (result.code) {
							case 0:
								_this.tableDep.listdata = result.data.list;
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