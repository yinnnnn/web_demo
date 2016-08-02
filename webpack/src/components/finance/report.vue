<template>
	<div class="content--wrap content--results">
		<div class="crumb-container">
			<crumb :items="crumbs"></crumb>
		</div>
    <router-view transition-mode="out-in"></router-view>
	</div>
</template>

<script>
	import crumb from '../common/crumb.vue';
	export default {
		route: {
			data ({to, next}) {
				console.log(to);
				let crumbs = [];
				let queryString = '';
				if (to.query.center == 1) {
					queryString = 'center=1';
					crumbs.push({
						text: '中心',
						link: '/results/report/center'
					});
				}
				if ((to.query.dn && to.query.did) || to.query.dep == 1) {
					let link = '/results/report/department';
					if (to.query.did && to.query.dn) {
						link = `${link}?${queryString}&dn=${to.query.dn}&did=${to.query.did}`;
					}
					crumbs.push({
						text: to.query.dn || '部门',
						link: link
					});
				}
				if ((to.query.tid && to.query.tn) || to.query.team == 1) {
					let link = '/results/report/team'
					if (to.query.tid && to.query.tn) {
						link = `${link}?${queryString}&tid=${to.query.tid}&tn=${to.query.tn}`;
					}
					crumbs.push({
						text: to.query.tn || '团队',
						link: link
					});
				}
				if (to.query.pid && to.query.pn) {
					queryString = `${queryString}&pn=${to.query.pn}&pid=${to.query.pid}`;
					crumbs.push({
						text: to.query.pn,
						link: '/results/report/personal?' + queryString
					})
				}
				if (crumbs.length == 0) {
					switch (to.name) {
						case 'report-center':
							crumbs.push({
								text: '中心',
								link: '/results/report/center'
							});
							break;
						case 'report-department':
							crumbs.push({
								text: '部门',
								link: '/results/report/department'
							})
							break;
						case 'report-team':
							crumbs.push({
								text: '团队',
								link: '/results/report/team'
							})
							break;
						case 'report-personal':
							crumbs.push({
								text: '个人',
								link: '/results/report/personal'
							});
							break;
					}
				}
				this.crumbs = crumbs;
			}
		},
		data () {
			return  {
				crumbs: []
			}
		},
		components: {
			crumb
		},
		methods: {

		}
	}
</script>

<style>
	
</style>