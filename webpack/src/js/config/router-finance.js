import getMenu  from './menu-finance';//页面配置
let defaultResultsReport = 'report-personal';
const config = {
	'/': {
		component:  (resolve) => {
			require(['../../components/finance/home.vue'], resolve);
		},
	},
	'/home': {
		component:  (resolve) => {
			require(['../../components/finance/home1.vue'], resolve);
		},
	},
	'/results/report': {
		name: 'report-home',
		component:  (resolve) => {
			require(['../../components/finance/report.vue'], resolve);
		},
		subRoutes: {
			'/': {
				name: 'report-default',
				component:  (resolve) => {
					require(['../../components/finance/'+ defaultResultsReport +'.vue'], resolve);
				}
			},
			'/personal': {
				name: 'report-personal',
				component:  (resolve) => {
					require(['../../components/finance/report-personal.vue'], resolve);
				}
			}
		}
	}
}

export default (router, data) => {
	router.map(config);
} 