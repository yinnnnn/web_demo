<template>
	<section class="login-content">
		<div class="title">
			<img class="icon" src="/dist/img/page/login_head.jpg" />
		</div>

		<div class="container">
			<div class="item item-email item-spacing">
				<input  @focus="this.error=''" class="input-text" v-model="username" type="text" placeholder="用户名" />
			</div>

			<div class="item item-lock item-spacing">
				<input @focus="this.error=''" class="input-text" v-model="password" type="password" placeholder="密码" />
			</div>

			<div class="item item-remember">
				<input v-model="remember" type="checkbox" /> 记住密码
				<a class="forget">忘记密码</a>
			</div>

			<div class="item item-submit item-spacing">
				<div class="error">{{error}}</div>
				<button @click="login" class="btn-submit">登录</button>
			</div>
		</div>
	</section>
</template>

<script>
	import md5 from 'md5';
	import sendAjax from '../js/common/request';
	export default {
		data () {
			return {
				username: '',
				password: '',
				remember: false,
				error: '',
			}
		},
		methods: {
			getMenu (){
				sendAjax({
					apiType: 'auth',
					url: '/permission/client_get_user_menu',
					success (result) {
						console.log(result);
					}
				})
			},
			login () {
				if (!$.trim(this.username)) {
					this.error = '请输入用户名';
				} else if (!this.password) {
					this.error = '请输入密码';
				}
				if (this.error) return;
				this.error = '';
				sendAjax({
					url: '/login/client_login',
					apiType: 'auth',
					data: {
						user: this.username,
						password: md5(this.password)
					},
					success: (result) => {
						switch (result.code) {
							case 0:
								localStorage['token'] = result.data.token;
								this.getMenu();
								break;
							default:
								this.error = '登录失败，请重新登录';
								break;
						}
						// localStorage['token'] = result.data.token;
						// localStorage['auth'] = result.data.auth;
					}
				});
			}
		}
	}
</script>

<style>
	
</style>