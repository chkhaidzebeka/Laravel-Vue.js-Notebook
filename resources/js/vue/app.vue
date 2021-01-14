<template>
	<div class="container">
		<div class="heading">
			<h2 id="title">Items List</h2>
			<hr>

			<add-item-form />
		</div>

		<list-view />

	</div>
</template>


<script>
import addItemForm from "./addItemForm"
import listView from "./listView"

export default {
	components: {
		addItemForm,
		listView
	}
};
</script>


<style scoped>
	.container {
		background: #e5e7eb73;
		margin: auto;
		max-width: 550px;
		border-radius: 2px;
	}

	.heading {
		padding: 10px;
	}

	#title {
		text-align: center;
	}
</style>

