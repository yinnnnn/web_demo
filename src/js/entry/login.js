import '../../scss/page/login.scss';
import Vue from 'vue';
// import login from '../../components/login.vue';
Vue.component('login', (resolve, reject) => {
	require(['../../components/login.vue'], resolve);
});

let finance = new Vue({
	el: 'body',
	components: {
		// login
	}
});

