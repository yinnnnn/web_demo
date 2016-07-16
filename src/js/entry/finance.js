import '../../scss/util/style.scss';
import '../../scss/page/finance.scss';
import Vue from 'vue';
import VueRouter from 'vue-router';
import routerConfig from '.././config/router';
import '.././common/native-extension';

Vue.use(VueRouter);
const router = new VueRouter();

// Vue.component('index', (resolve, reject) => {
// 	require(['../components/finance/index.vue'], resolve);
// });
routerConfig(router);

const App = Vue.extend(require('../../components/finance/index.vue'));
router.start(App, '#app');

window.router = router;
// import sidebar from '../components/common/sidebar.vue';
// Vue.component('sidebar', sidebar);

// let finance = new Vue({
// 	el: 'body',
// 	data () {
// 		return {
// 			menu: financeMenu
// 		}
// 	},
// 	components: {
// 		// sidebar
// 	},
// 	methods: {
// 		select (value) {
// 			this.compt = value;
// 		}
// 	}
// });

