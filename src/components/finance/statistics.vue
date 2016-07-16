<template>
	<div class="content--wrap content--results">
		<tabs :active.sync="tabIndex">
      <tab header="个人">
      </tab>
      <tab header="团队"></tab>
      <tab header="部门"></tab>
      <tab header="中心"></tab>
    </tabs>

    <router-view transition-mode="out-in" keep-alive></router-view>
	</div>
</template>

<script>
	import { tabset, tab } from 'vue-strap';
	export default {
		data () {
			return  {
				tabIndex: 0,
			}
		},
		created () {
			let name = this.$route.path.replace('/results/statistics/', '');
			console.log(name);
			switch (name) {
				case 'team':
					this.tabIndex = 1;
					break;
				case 'department':
					this.tabIndex = 2;
					break;
				case 'center':
					this.tabIndex = 3;
					break;
			}
		},
		watch: {
			'tabIndex' (newVal, oldVal) {
				let path = '';
				switch (newVal) {
					case 0: 
						path = 'personal';
						break;
					case 1:
						path = 'team';
						break;
					case 2:
						path = 'department';
						break;
					case 3:
						path = 'center';
						break;
				}
				router.go({
					path: '/results/statistics/' + path
				})
			}
		},
		components: {
			tabs: tabset,
			tab: tab
		},
		methods: {

		}
	}
</script>

<style>
	
</style>