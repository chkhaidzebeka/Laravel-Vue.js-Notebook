<template>
	<div id="list">
		<div v-for="(item,index) in items" :key="index">
			<list-item
				:item="item"
				class="item"
				@itemchanged="$emit('reloadList')"
			/>
		</div>
	</div>
</template>

<script>
import listItem from './listItem'
export default {
	props: ["items"],
	components: {
		listItem
	}
};
</script>

<style>
#list {
	margin-top: 10px;
	border-radius: 2px;
}
.item {
	background: #ecf0f1;
	padding: 5px;
	padding-top: 5px;
}	
</style>
