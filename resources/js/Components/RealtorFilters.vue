<template>
    <form action="">
        <div class="my-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center gap-2">
                <input v-model="filterForm.deleted" type="checkbox" class="h-4 w-4 rounded border" id="deleted">
                <label for="deleted">Deleted</label>
            </div>
            <div>
                <select v-model="filterForm.by" class="input-filter w-24 mr-4">
                  <option value="created_at">Added</option>
                  <option value="price">Price</option>
                  <option value="area">Area</option>
                </select>
                <select v-model="filterForm.order" class="input-filter w-40">
                  <option
                    v-for="option in sortOptions" 
                    :key="option.value" :value="option.value"
                  >
                    {{ option.label }}
                  </option>
                </select>
              </div>
        </div>
    </form>
</template>

<script setup>
    import { reactive, watch, computed } from 'vue';
    // import {Inertia} from '@inertiajs/inertia'; not working after inertia update to v1.0 replaced with below
    import { router } from '@inertiajs/vue3';
    import { debounce } from 'lodash';

    const sortLabels = {
  created_at: [
    {
      label: 'Latest',
      value: 'desc',
    },
    {
      label: 'Oldest',
      value: 'asc',
    },
  ],
  price: [
    {
      label: 'Most expensive',
      value: 'desc',
    },
    {
      label: 'Cheapest',
      value: 'asc',
    },
  ],
  area: [
    {
      label: 'Biggest',
      value: 'desc',
    },
    {
      label: 'Smallest',
      value: 'asc',
    },
  ],
}
const sortOptions = computed(() => sortLabels[filterForm.by])

    const filterForm = reactive({
        deleted: false,
        by: 'created_at',
        order: 'desc'
    })

    // watch(() => filterForm.deleted, (newValue, oldValue) => {
    //     console.log('Deleted value changed from', oldValue, 'to', newValue)
    // })
    
//debounce is like settimeout, you can click as fast as you want, it will send request after 1 sec delay.
    watch(
        filterForm, debounce(() => router.get(
            route('realtor.listing.index'),
            filterForm,
            { preserveState: true, preserveScroll: true },
        ), 1000),
    )


</script>