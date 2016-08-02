<template>
	<table class="table">
		<thead>
			<tr>
				<th v-for="item in head" :class="[item.class?item.class:'col-xs-1']">
					<button v-if="item.filterType==='sort'"
						@click="sort(item,$index)"
					  class="sort" :class="[item.sortType?'sort__desc':'']" 
					  href="javascript: void(0)">
						  {{item.text}}
					</button>
					<span v-if="!item.filterType || item.filterType==='text'">{{item.text}}</span>
				</th>
			</tr>
		</thead>

		<tbody>
			<tr v-for="(index, item) in listdata"  :class="{'odd': !(index%2==0)}" >
				<td v-for="attr in head">
					<a v-if="attr.type==='link'" v-link="{path: attr.typeValue + '?id=' + item.id }">
						{{item[attr.name]}}
					</a>
					<a v-if="attr.type==='callback'" @click="attr.typeValue(item)" >{{item[attr.name]}}</a>
					<span v-if="!attr.type ||attr.type==='text'">
						{{item[attr.name]}}
					</span>
				</td>
			</tr>
		</tbody>
	</table>
</template>

<script>
	export default {
		props: {
			//表格头部参数
			head: {
				type: Array,
				required: true,
				default: []
			},
			//表格主体数据
			listdata: {
				type: Array,
				required: true,
				default: []
			},
			//是否自动筛选
			filterAuto: {
				type: Boolean,
				default: true
			}
		},
		data () {
			return {
			}
		},
		methods: {
			sort(item, index) {
				console.log('sort');
				if (!item.name) return;
				if (item.sortType == undefined) {
					item = Object.assign({}, item, {sortType: true});
				} else  {
					item.sortType = !item.sortType;
				}
				this.head.$set(index, item);
				if (this.filterAuto) {
					let newData = [...this.listdata];
					newData = newData.sortAttr(item.name, item.sortType);
					this.$set('listdata', newData);
				} else  {
					this.dispatch('filter',{
						name: item.name,
						sort: newItem.sortType,
						type: 'sort'
					});
				}	
			}
		}
	}
</script>
