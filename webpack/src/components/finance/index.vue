<template>
<div>
	<page-header></page-header>
	<section class="content">
		<sidebar :skip-route.sync="menuRoute" :menu="menu"></sidebar>
		<router-view transition-mode="out-in"></router-view>
	</section>
</div>
</template>

<script>
	import financeMenu from '../../js/config/menu';
	import header from '../common/header.vue';
	import sidebar from '../common/sidebar1.vue';
	export default {
		data () {
			let menu = JSON.parse(localStorage.getItem('menu'));
			return  {
				menu: menu,
				menuRoute: ''
			}
		},
		events: {
			menuSkip (value) { 
				this.menuRoute = value;
			}
		},
		components: {
			sidebar: sidebar,
			pageHeader: header, 
		}
	}
</script>
