<template>
  <form @submit.prevent="create">
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-2">
        <label class="label">Beds</label>
        <input v-model.number="form.beds" class="input" type="text" />
        <div class="input-error" v-if="form.errors.beds">
          {{ form.errors.beds }}
        </div>
      </div>
      <div class="col-span-2">
        <label class="label">Baths</label>
        <input v-model.number="form.baths" class="input" type="text" />
        <div class="input-error" v-if="form.errors.baths">
          {{ form.errors.baths }}
        </div>
      </div>
      <div class="col-span-2">
        <label class="label">Area</label>
        <input v-model.number="form.area" class="input" type="text" />
        <div class="input-error" v-if="form.errors.area">
          {{ form.errors.area }}
        </div>
      </div>
      <div class="col-span-4">
        <label class="label">City</label>
        <input v-model="form.city" class="input" type="text" />
        <div class="input-error" v-if="form.errors.city">
          {{ form.errors.city }}
        </div>
      </div>
      <div class="col-span-2">
        <label class="label">Post Code</label>
        <input v-model="form.code" class="input" type="text" />
        <div class="input-error" v-if="form.errors.code">
          {{ form.errors.code }}
        </div>
      </div>
      <div class="col-span-4">
        <label class="label">Street</label>
        <input v-model="form.street" class="input" type="text" />
        <div class="input-error" v-if="form.errors.street">
          {{ form.errors.street }}
        </div>
      </div>
      <div class="col-span-2">
        <label class="label">Street Nr</label>
        <input v-model.number="form.street_nr" class="input" type="text" />
        <div class="input-error" v-if="form.errors.street_nr">
          {{ form.errors.street_nr }}
        </div>
      </div>
      <div class="col-span-6">
        <label class="label">Price</label>
        <input v-model.number="form.price" class="input" type="text" />
        <div class="input-error" v-if="form.errors.price">
          {{ form.errors.price }}
        </div>
      </div>
      <div>
        <button class="primary-btn" type="submit">Create</button>
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