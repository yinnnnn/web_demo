const config = {
	'/results/report': {
		component:  (resolve) => {
			require(['../../components/finance/report.vue'], resolve);
		},
		subRoutes: {
			'/': {
				component:  (resolve) => {
					require(['../../components/finance/report-personal.vue'], resolve);
				}
			},
			'/personal': {
				component:  (resolve) => {
					require(['../../components/finance/report-personal.vue'], resolve);
				}
			},
			'/team': {
				component:  (resolve) => {
					require(['../../components/finance/report-team.vue'], resolve);
				}
			},
			'/department': {
				component:  (resolve) => {
					require(['../../components/finance/report-department.vue'], resolve);
				}
			},
			'/center': {
				component:  (resolve) => {
					require(['../../components/finance/report-center.vue'], resolve);
				}
			}
		}
	},
	'/results/statistics': {
		component: (resolve) => {
			require(['../../components/finance/statistics.vue'], resolve);
		},
		subRoutes: {
			'/': {
				component:  (resolve) => {
					require(['../../components/finance/statistics-personal.vue'], resolve);
				}
			},
			'/personal': {
				component:  (resolve) => {
					require(['../../components/finance/statistics-personal.vue'], resolve);
				}
			},
			'/team': {
				component:  (resolve) => {
					require(['../../components/finance/statistics-team.vue'], resolve);
				}
			},
			'/department': {
				component:  (resolve) => {
					require(['../../components/finance/statistics-department.vue'], resolve);
				}
			},
			'/center': {
				component:  (resolve) => {
					require(['../../components/finance/statistics-center.vue'], resolve);
				}
			}
		}
	},
	'/': {
		component: (resolve) => {
			require(['../../components/finance/report.vue'], resolve);
		},
	}
}

export default (router) => {
	router.map(config);
} 