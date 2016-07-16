<template>
<div>
	<page-header></page-header>
	<section class="content">
		<sidebar :menu="menu"></sidebar>
		<router-view transition-mode="out-in" keep-alive></router-view>
	</section>
</div>
</template>

<script>
	import financeMenu from '../../js/config/menu';
	import header from '../common/header.vue';
	import sidebar from '../common/sidebar.vue';
	export default {
		data () {
			return  {
				menu: financeMenu
			}
		},
		components: {
			sidebar: sidebar,
			pageHeader: header,
		},
		methods: {
		},

		ready () {

		}
	}
</script>

<style>
	
</style>