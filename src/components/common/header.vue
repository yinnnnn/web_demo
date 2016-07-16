<template>
	<header class="header">
		<div class="header--logo">
			<a @click="showMenu" href="javascript:void(0)" class="icon"><img src="../../img/icon/header_1.png" /></a>
			<span class="text">泰九运筹管理系统</span>
		</div>

		<div class="header--user">

			<div class="item item-user">
				<a href="javascript:void(0)" class="icon">
					<img src="../../img/icon/user_picture_1.png" />
				</a>
				<a href="javascript:void(0)" class="text">Gary</a>
			</div>

			<div class="item item-logout">
				<a href="javascript:void(0)" class="icon"><img src="../../img/icon/logout_1.png" /></a>
				<a href="javascript:void(0)" class="text">退出</a>
			</div>
		</div>

		<div class="header--menu" :style="{display: isShowMenu?'block':'none'}">
			<a href="javascript:void(0)" class="item item-green-1">人力</a>
			<a href="javascript:void(0)" class="item item-green-2">机构</a>
			<a href="javascript:void(0)" class="item item-default"></a>
			<a href="javascript:void(0)" class="item item-red">企业</a>
			<a href="javascript:void(0)" class="item item-blue">财务</a>
			<a href="javascript:void(0)" class="item"></a>
			<a href="javascript:void(0)" class="item item-default"></a>
		</div>
	</header>
</template>

<script>
	export default {
		data () {
			return {
				isShowMenu: false
			}
		},
		methods: {
			showMenu () {
				this.isShowMenu = !this.isShowMenu;
			}
		}
	}
</script>
<style>
	
</style>