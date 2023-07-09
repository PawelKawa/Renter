<template>
	<form @submit.prevent="create">
		<div class="grid grid-cols-6 gap-4">
			<div class="col-span-2">
				<label class="block mb-1 dark:text-gray-200">Beds</label>
				<input class="block w-full p-2 rounded-md shadow-sm border dark:bg-gray-400" v-model.number="form.beds" type="text" />
				<div v-if="form.errors.beds">
					{{ form.errors.beds }}
				</div>
			</div>
			<div class="col-span-2">
				<label class="block mb-1 dark:text-gray-200">Baths</label>
				<input class="block w-full p-2 rounded-md shadow-sm border dark:bg-gray-400" v-model.number="form.baths" type="text" />
				<div v-if="form.errors.baths">
					{{ form.errors.baths }}
				</div>
			</div>
			<div class="col-span-2">
				<label class="block mb-1 dark:text-gray-200">Area</label>
				<input class="block w-full p-2 rounded-md shadow-sm border dark:bg-gray-400" v-model.number="form.area" type="text" />
				<div v-if="form.errors.area">
					{{ form.errors.area }}
				</div>
			</div>
			<div class="col-span-4">
				<label class="block mb-1 dark:text-gray-200">City</label>
				<input class="block w-full p-2 rounded-md shadow-sm border dark:bg-gray-400" v-model="form.city" type="text" />
				<div v-if="form.errors.city">
					{{ form.errors.city }}
				</div>
			</div>
			<div class="col-span-2">
				<label class="block mb-1 dark:text-gray-200">Post Code</label>
				<input class="block w-full p-2 rounded-md shadow-sm border dark:bg-gray-400" v-model="form.code" type="text" />
				<div v-if="form.errors.code">
					{{ form.errors.code }}
				</div>
			</div>
			<div class="col-span-4">
				<label class="block mb-1 dark:text-gray-200">Street</label>
				<input class="block w-full p-2 rounded-md shadow-sm border dark:bg-gray-400" v-model="form.street" type="text" />
				<div v-if="form.errors.street">
					{{ form.errors.street }}
				</div>
			</div>
			<div class="col-span-2">
				<label class="block mb-1 dark:text-gray-200">Street Nr</label>
				<input class="block w-full p-2 rounded-md shadow-sm border dark:bg-gray-400" v-model.number="form.street_nr" type="text" />
				<div v-if="form.errors.street_nr">
					{{ form.errors.street_nr }}
				</div>
			</div>
			<div class="col-span-6">
				<label class="block mb-1 dark:text-gray-200">Price</label>
				<input class="block w-full p-2 rounded-md shadow-sm border dark:bg-gray-400" v-model.number="form.price" type="text" />
				<div v-if="form.errors.price">
					{{ form.errors.price }}
				</div>
			</div>
			<div>
				<button class="col-span-6 bg-indigo-600 hover:bg-indigo-500 text-white font-medium p-2 rounded-md" type="submit">Create</button>
			</div>
		</div>
	</form>
</template>

<script setup>
	// import { reactive } from 'vue'
	import { useForm } from '@inertiajs/vue3'
	const form = useForm({
		beds: 0,
		baths: 0,
		area: 0,
		city: null,
		code: null,
		street: null,
		street_nr: null,
		price: 0,

	})
	const create = () => form.post(route('listing.store'))
</script>

<script>
	import MainLayout from '@/Layouts/MainLayout.vue'
	export default {
		layout: MainLayout,
	}
</script>

<!-- Loading something like presistent Layouts and thanks to that timer is not restarting when swaping pages. -->
<style scoped>
	label {
		margin-right: 2em;
	}

	div {
		padding: 2px
	}

	input {
		border: 1px black solid;
	}
</style>