import '../../scss/util/style.scss';//引用scss文件
import '../../scss/page/finance.scss';//引用scss文件 js里面??
import '../../scss/page/finance_1.scss';//引用scss文件 js里面??
import Vue from 'vue';
import VueRouter from 'vue-router';//路由
import routerConfig from '.././config/router-finance';//各个页面的vue
import '.././common/native-extension';//扩展js
import sendAjax from '../common/request.js';//ajax扩展js

const platCode = '101';
localStorage['plat'] = platCode;

/* vue && vue-router */
Vue.use(VueRouter);
const router = new VueRouter();
//是怎么route进去的？
routerConfig(router, []);
const App = Vue.extend(require('../../components/finance/index.vue'));
router.start(App, '#app');
window.router = router;
