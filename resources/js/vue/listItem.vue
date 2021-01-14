<template>
	<div class="item">
		<input
			type="checkbox"
			@change="updateCheck()"
			v-model="item.read"
		/>
		
		<a :href="item.link" target="_blank" :title="item.link" :class="[item.read ? 'completed' : '','itemText']">{{ item.name }}</a>


		<button @click="removeItem()" class="trashcan">
			<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
		</button>
	</div>
</template>

<script>
export default {
	props: ['item'],
	methods: {
		updateCheck() {
			axios.put('api/v1/article/'+this.item.id,{
				item: this.item
			})
			.then(resp => {
				console.log(resp)
				if (resp.status == 200) {
					this.$emit('itemchanged')
				}
			}).catch(err => console.log(err))
		},
		removeItem() {
			axios.delete('api/v1/article/'+this.item.id)
			.then(resp => {
				console.log(resp)
				if (resp.status == 200) {
					this.$emit('itemchanged')
				}
			}).catch(err => console.log(err))
		}
	}
};
</script>

<style>
.completed {
	text-decoration: line-through;
	color: #999;
}

.itemText {
	width: 100%;
	margin-left: 20px;
}

.item {
	display: flex;
	justify-content: center;
	align-items: center;
}

.w-6 {
	width: 1rem;
}

.h-6 {
	height: 1rem;
}

.trashcan {
	background: #e6e6e6;
	border: none;
	outline: none;
	color: #ff0000;
	cursor: pointer;
}
</style>
