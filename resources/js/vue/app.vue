<template>
	<div class="container">
		<div class="heading">
			<h2 id="title">Articles List</h2>
			<hr>

			<add-item-form
				@reloadList="getList()"
			/>
		</div>

		<list-view 
			:items="items"
			@reloadList="getList()"
		/>

	</div>
</template>


<script>
import addItemForm from "./addItemForm"
import listView from "./listView"

export default {
	components: {
		addItemForm,
		listView
	},
	data: function(){
		return {
			items: []
		}
	},
	methods: {
		getList(){
			axios.get('api/v1/article/all')
			.then(resp => {
				this.items = resp.data
			}).catch(err => {
				console.log(err)
			})
		}
	},
	created() {
		this.getList();
	}
};
</script>


<style scoped>
	.container {
		margin: auto;
		max-width: 550px;
		border-radius: 2px;
	}

	.heading {
		background: #e5e7eb73;

		padding: 10px;
	}

	#title {
		text-align: center;
	}
</style>

