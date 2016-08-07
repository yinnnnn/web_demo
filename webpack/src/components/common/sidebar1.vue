<template>
	<aside class="sidebar1">
		<div class="sidebar1">
                    <!--type-home是因为字体大小不一样-->
                    <a class="sidebar1--title type-home sidebar--selected">
                        <span class="icon"></span>
                        <div class="text">首页</div>
                    </a>
                    <ul class="sidebar1--memu sidebar1--menu__open ">
                        <li> 
                            <a class="sidebar1--title type-finance-1">
                                <div class="icon"></div>
                                <div class="text">业绩查询</div>
                                <div class="arrow"></div>
                            </a>
                        </li>
                        <li>
                            <a class="sidebar1--title sidebar1--memu--item">
                                <div class="icon"></div>
                                <div class="text">业绩日报</div>
                            </a>
                        </li>
                        <li>
                            <a class="sidebar1--title sidebar1--memu--item">
                                <div class="icon"></div>
                                <div class="text">业绩统计</div>
                            </a>
                        </li>
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
					openClass: 'sidebar1--menu__open',
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