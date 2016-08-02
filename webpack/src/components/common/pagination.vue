<template>
	<ul class="pagination">
    <li>
      <a @click="selected(1)">&laquo;</a>
    </li>
    <li v-for="item in items">
    	<a @click="selected(item.value)" :class="{current: item.value==index}">{{item.text}}</a>
    <li>
      <a @click="selected(num)">&raquo;</a>
    </li>
  </ul>
</template>
<script>
	export default {
		ready () {
			this.initData();
		},
		props: {
			//回调函数
			callback: Function,
			//每页显示数量
			pagesize: {
				type: Number,
				default: 1
			},
			//选中页
			index: {
				type: Number,
				default: 1
			},
			//总条数
			total: {
				type: Number,
				default: 1
			},
			//重新设置
			reset: {
				type: Boolean,
				default: false
			}
		},
		watch: {
			'total' (newVal, oldVal) {
				this.initData();
			},
			'reset' (newVal, oldVal) {
				if (!newVal) return;
				this.reset = false;
				this.initData();
			},
			'index' (newVal, oldVal) {
				this.initData();
			},
			pagesize (newVal, oldVal) {
				this.initData();
			}
		},
		data () {
			return {
				num: 1,
				items: []
			}
		},
		methods: {
			initData () {
				let arr = [];
				this.num = Math.ceil(this.total / this.pagesize);
				if (this.index > this.num) {
					this.index = 1;
				}
				if (this.num < 6) {
					for( let i = 0; i < this.num; i++ ) {
						arr.push({
							value: i + 1,
							text: i + 1
						});
					}
				} else  {
					arr.push({
						value: 1,
						text: 1
					});
					if (this.index - 1 > 2 && this.index + 1 < this.num -2) {
						arr.push({
							value: this.index - 2,
							text: '...'
						});
						arr.push({
							value: this.index - 1,
							text: this.index - 1
						});
						arr.push({
							value: this.index,
							text: this.index
						});
						arr.push({
							value: this.index + 1,
							text: this.index + 1
						});
						arr.push({
							value: this.index + 2,
							text: '...'
						});
					} else {
						if (this.index - 1 <= 2) {
							arr.push({
								value: 2,
								text: 2,
							});
							arr.push({
								value: 3,
								text: 3,
							});
							arr.push({
								value: 4,
								text: 4,
							});
							arr.push({
								value: 5,
								text: '...',
							})
						} else  {
							arr.push({
								value: this.num - 4,
								text: '...',
							});
							arr.push({
								value: this.num - 3,
								text: this.num - 3,
							});
							arr.push({
								value: this.num - 2,
								text: this.num - 2,
							});
							arr.push({
								value: this.num - 1,
								text: this.num - 1,
							});
						}
					}
					arr.push({
						value: this.num,
						text: this.num,
					});
				}
				this.items = arr;
			},
			selected (value) {
				if (value == this.index) return;
				this.index = value;
				this.initData();
				this.callback && this.callback(value);
			}
		}
	}
</script>