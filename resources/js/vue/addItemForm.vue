<template>
	<div>
		<div class="additem">

			<p class="alert" :class="messages.type" v-if="alert">{{ this.messages.text }}</p>

			<label for="name">Article Name</label>
			<input type="text" @keyup.enter="addItem()" id="name" placeholder="How to lose weight" v-model="items.name">

			<label for="name">Article Link</label>
			<input type="url" @keyup.enter="addItem()" placeholder="https://website.te/articles/1" v-model="items.link" />

			<button @click="addItem()">Add
				<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
			</svg>
			</button>
		</div>
	</div>
</template>


<script>
	export default {
		data: function() {
			return {
				items: {
					name: "",
					link: ""
				},
				messages: {
					type: null,
					text: null
				},
				alert: false
			}
		},
		methods: {
			addItem() {
				if (this.items.name == '' || this.items.link == '') {
					this.setMessages('warning','Please enter inputs')
					return false;
				}

				if(!this.validateUrl(this.items.link)) {
					this.setMessages('warning','Link is not a valid URL')
					return false;
				}
				
				axios.post('api/v1/article/new',{
					name: this.items.name,
					link: this.items.link
				}).then(resp => {
					this.setMessages('success','Article added successfully')
					this.freeInputs()
					this.$emit('reloadList')
				}).catch(err => {
					console.log(err)
					this.setMessages('warning','Please try different link')
				});
			},
			showAlert() {
				this.alert = true;
				setTimeout(() => {
					this.alert = false
				},4000)
			},
			setMessages(type,text){
				this.messages.type = type
				this.messages.text = text
				this.showAlert()
			},
			freeInputs() {
				this.items.name = this.items.link = ""
			},
			validateUrl(string) {
				let url;

				try {
					url = new URL(string);
				} catch (_) {
					return false;  
				}

				return url.protocol === "http:" || url.protocol === "https:";
			}
		}
	};
</script>

<style scoped>
	.additem {
		margin-top: 20px;
	}

	input {
		display: block;
		width: 100%;
		background: #d1d5db;
		border: none;
		outline: none;
		padding: 10px;
		border-radius: 2px;
		margin: 5px auto;
	}

	input:focus {
		outline: 2px solid #2980b9;
		border-radius: 3px;
		-moz-outline-radius: 4px;
		font-weight: lighter;
	}

	button {
		width: 100%;
		margin-top: 10px;
		border: none;
		outline: none;
		background: #3498db;
		padding: 10px;
		border-radius: 2px;
		cursor: pointer;
		color: white;
	}

	button:hover {
		background-color: #2286ca;
		border-radius: 3px;
	}

	svg {
		vertical-align: middle;
	}

	.alert {
		border-radius: 2px;
		padding: 3px 7px;
	}

	.warning {
		background: #ffde57;
		color: #ad6b03;
	}

	.success {
		background: #82e482;
		color: #08632f;
	}

	.w-6 {
		width: 1rem;
	}

	.h-6 {
		height: 1rem;
	}

</style>
