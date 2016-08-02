<template>
	<nav style="display: inline-block;width">
    <ul>
      <li><a @click="click('index')" href="javascript:void(0)">财务1</a></li>
      <li><a href="javascript:void(0)">财务2</a></li>
      <li><a href="javascript:void(0)">财务3</a></li>
    </ul>
  </nav>
</template>

<script>
	export default {
		props: {
			select: Function
		},
		data () {
			return  {
				name: 'navigation'
			}
		},
		methods: {
			click (value) {
				this.props.select && this.props.select(value);
			}
		}
	}
</script>

<style>
	
</style>