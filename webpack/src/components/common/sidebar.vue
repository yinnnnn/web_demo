<template>
	<aside class="sidebar">

		<div class="sidebar">
			<a @click="selectedHome" v-link="{'path': menuObj.homeLink}" class="sidebar--title type-home" :class="[menuObj.isHome ? menuObj.selectedClass: '']">
				<div class="icon"></div>
				<div class="text">首页</div>
			</a>
			<ul v-for="item in menuObj.tree" class="sidebar--menu" :class="[item.isOpen?menuObj.openClass:'']">
				<li>
					<a class="sidebar--title sidebar--menu--head" :class="['sidebar--title', item.titleClass]" @click="openMenu(item)">
						<div class="icon"></div>
						<div class="text">{{item.text}}</div>
						<div class="arrow"></div>
					</a>
				</li>

				<li v-for="sub in item.subs">
					<a @click="selected(sub)" v-link="{'path': sub.link}" class="sidebar--menu--item"  :class="[sub.selected?menuObj.selectedClass:'']">
						<div class="icon"></div>
						<div class="text">{{sub.text}}</div>
					</a>
				</li>
			</ul>
		</div>

		 <div class="sidebar">
			<a class="sidebar--title type-home sidebar--selected">
				<div class="icon"></div>
				<div class="text">首页</div>
			</a>

			<ul class="sidebar--menu sidebar--menu__open">
				<li>
					<a class="sidebar--title type-finance-1">
						<div class="icon"></div>
						<div class="text">业绩查询</div>
						<div class="arrow"></div>
					</a>
				</li>

				<li>
					<a class="sidebar--title sidebar--menu--item  sidebar--selected">
						<div class="icon"></div>
						<div class="text">业绩日报</div>
					</a>
				</li>

				<li>
					<a class="sidebar--title sidebar--menu--item">
						<div class="icon"></div>
						<div class="text">业绩报表</div>
					</a>
				</li>
			</ul>

			<ul class="sidebar--menu">
				<li>
					<a class="sidebar--title type-finance-2">
						<div class="icon"></div>
						<div class="text">工资报表</div>
						<div class="arrow"></div>
					</a>
				</li>

				<li>
					<a class="sidebar--title sidebar--menu--item">
						<div class="icon"></div>
						<div class="text">工资详情</div>
					</a>
				</li>

				<li>
					<a class="sidebar--title sidebar--menu--item">
						<div class="icon"></div>
						<div class="text">工资统计</div>
					</a>
				</li>
			</ul>

			<ul class="sidebar--menu">
				<li>
					<a class="sidebar--title type-finance-3">
						<div class="icon"></div>
						<div class="text">经营分析</div>
						<div class="arrow"></div>
					</a>
				</li>

				<li>
					<a class="sidebar--title sidebar--menu--item">
						<div class="icon"></div>
						<div class="text">分析报告</div>
					</a>
				</li>

				<li>
					<a class="sidebar--title sidebar--menu--item">
						<div class="icon"></div>
						<div class="text">收入中心</div>
					</a>
				</li>

				<li>
					<a class="sidebar--title sidebar--menu--item">
						<div class="icon"></div>
						<div class="text">成本中心</div>
					</a>
				</li>

				<li>
					<a class="sidebar--title sidebar--menu--item sidebar--menu--item">
						<div class="icon"></div>
						<div class="text">利润中心</div>
					</a>
				</li>

				<li>
					<a class="sidebar--title sidebar--menu--item sidebar--menu--item">
						<div class="icon"></div>
						<div class="text">外部数据上传</div>
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