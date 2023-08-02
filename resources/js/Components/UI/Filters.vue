<template>
    <form @submit.prevent="filter">
        <div class="mb-8 mt-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center">
                <input type="text" placeholder="Price from" class="input-filter" v-model.number="filterForm.priceFrom"/>
                <input type="text" placeholder="Price to" class="input-filter " v-model.number="filterForm.priceTo"/>
            </div>

            <div class="flex flex-nowrap items-center">
                <select class="input-filter" v-model="filterForm.minBeds">
                    <option :value="null">Min beds</option>
                    <option v-for="n in 6" :key="n" :value="n">{{ n }}</option>
                </select>
                <select class="input-filter" v-model="filterForm.maxBeds">
                    <option :value="null">Max beds</option>
                    <option v-for="n in 6" :key="n" :value="n">{{ n }}</option>
                </select>
            </div>
            <div class="flex flex-nowrap items-center">        
                <select class="input-filter" v-model="filterForm.minBaths">
                    <option :value="null">Min baths</option>
                    <option v-for="n in 6" :key="n" :value="n">{{ n }}</option>
                </select>
                <select class="input-filter" v-model="filterForm.maxBaths">
                    <option :value="null">Max baths</option>
                    <option v-for="n in 6" :key="n" :value="n">{{ n }}</option>
                </select>
            </div>

            <div class="flex flex-nowrap items-center">
                <input type="text" placeholder="Area from" class="input-filter" v-model.number="filterForm.areaFrom"/>
                <input type="text" placeholder="Area to" class="input-filter" v-model.number="filterForm.areaTo"/>
            </div>
            <div class="flex gap-4 ml-2">
                <button type="submit" class="primary-btn">Filter</button>
                <button type="reset" @click="clear" class="btn-normal">Clear</button>
            </div>
        </div>
    </form>
</template>

<script setup>
   import { useForm } from '@inertiajs/vue3'
    const props = defineProps({
        filters: Object
        })
        const filterForm = useForm({
            priceFrom: props.filters.priceFrom ?? null,
            priceTo: props.filters.priceTo ?? null,
            minBeds: props.filters.minBeds ?? null,
            maxBeds: props.filters.maxBeds ?? null,
            minBaths: props.filters.minBaths ?? null,
            maxBaths: props.filters.maxBaths ?? null,
            areaFrom:props.filters.areaFrom ?? null,
            areaTo:props.filters.areaTo ?? null,
        })
        const filter = () => {
            filterForm.get(
                route('listing.index'),
                {
                    preserveState: true,
                    preserveScroll: true,
                }
            )
        }
        const clear = () => {
            filterForm.priceTo = null,
            filterForm.priceFrom = null,
            filterForm.minBeds = null,
            filterForm.maxBeds = null,
            filterForm.minBaths = null,
            filterForm.maxBaths = null,
            filterForm.areaFrom = null,
            filterForm.areaTo = null
            filter()
        }
</script>