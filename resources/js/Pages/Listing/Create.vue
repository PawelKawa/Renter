<template>
    <form @submit.prevent="create">
        <div>
            <div>
                <label>Beds</label>
                <input type="text" v-model.number="form.beds" />
                <div v-if="form.errors.beds">
                    {{form.errors.beds}}
                </div>
            </div>

            <div>
                <label>Baths</label>
                <input type="text" v-model.number="form.baths" />
            </div>
            <div v-if="form.errors.baths">
                {{form.errors.baths}}
            </div>
            <div>
                <label>Area</label>
                <input type="text" v-model.number="form.area" />
            </div>
            <div v-if="form.errors.area">
                {{form.errors.area}}
            </div>
            <div>
                <label>City</label>
                <input type="text" v-model="form.city" />
            </div>
            <div v-if="form.errors.city">
                {{form.errors.city}}
            </div>
            <div>
                <label>Post Code</label>
                <input type="text" v-model="form.code" />
            </div>
            <div v-if="form.errors.code">
                {{form.errors.code}}
            </div>
            <div>
                <label>Street</label>
                <input type="text" v-model="form.street" />
            </div>
            <div v-if="form.errors.street">
                {{form.errors.street}}
            </div>
            <div>
                <label>Street Nr</label>
                <input type="text" v-model.number="form.street_nr" />
            </div>
            <div v-if="form.errors.street_nr">
                {{form.errors.street_nr}}
            </div>
            <div>
                <label>Price</label>
                <input type="text" v-model.number="form.price" />
            </div>
            <div v-if="form.errors.price">
                {{form.errors.price}}
            </div>
            <div>
                <button type="submit">Create</button>
            </div>
        </div>
    </form>
</template>

<script setup>
    import { reactive } from 'vue'
    import { useForm } from '@inertiajs/vue3'
    const form = useForm({
        beds: 0,
        baths: 0,
        area: 0,
        city: null,
        code: null,
        street: null,
        street_nr: null,
        price: 0

    })
    const create = () => form.post(route('listing.store'))
</script>

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

<!-- Loading something like presistent Layouts and thanks to that timer is not restarting when swaping pages. -->
<script>
import MainLayout from '@/Layouts/MainLayout.vue'
export default {
    layout: MainLayout,
}
</script>