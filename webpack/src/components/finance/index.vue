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
</script>

<style>
	
</style>