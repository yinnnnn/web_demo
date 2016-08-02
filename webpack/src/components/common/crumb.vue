<template>
	<ul class="crumbs">
		<li v-for="(index, item) in items">
			<span class="arrow-min right" v-if="index > 0" ></span>
			<a v-if="index < items.length - 1" href="#" v-link="{path: item.link}">{{item.text}}</a>
			<span v-if="index === items.length - 1">{{item.text}}</span>
		</li>
	</ul>
</template>

<script>
	export default {
		props: {
			items: {
				type: Array,
				required: true
			}
		},
		data () {
			return {};
		}
	}
</script>