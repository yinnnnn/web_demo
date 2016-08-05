<template>
	<aside class="sidebar">
		<div class="sidebar">
                    <a>
                        <img src="/dist/img/sidebar_home_1.png" alt="" />
                        <div>首页</div>
                    </a>
                    <ul>
                        <li>业绩查询</li> 
                        <li>业绩日报</li>
                        <li>业绩统计</li>
                    </ul>
		</div>

	</aside>

</template>

<script>
	import '../../scss/util/style.scss';
	export default {
		props: {
			menu: { 
				type: Object,
				required: true
			}
		},
		created() {
			console.log(this.menu);
			this.menuObj = Object.assign({},this.menuObj,this.menu);
		},
		ready () {
			console.log(this.menu);
		},
		data () {
			return  {
				menuObj: {
					selectedClass: 'selected',
					openClass: 'sidebar--menu__open',
					isHome: false,
				}
			}
		},
		methods: {
			openMenu (menu) {
				menu.isOpen = !menu.isOpen;
			},
			selectedHome () {
				this.cleanSubSelected();
				this.menuObj.isHome = true;
			},
			cleanSubSelected () {
				for (let i in this.menuObj.tree) {
					for (let j in this.menuObj.tree[i].subs) {
						this.menuObj.tree[i].subs[j].selected = false;
					}
				}
			},
			selected(sub) {
				this.menuObj.isHome = false;
				this.cleanSubSelected();
				sub.selected = true;
			}
		}
	}
</script>