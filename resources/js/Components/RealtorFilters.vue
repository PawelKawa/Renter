<template>
    <form action="">
        <div class="my-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center gap-2">
                <input v-model="filterForm.deleted" type="checkbox" class="h-4 w-4 rounded border" id="deleted">
                <label for="deleted">Deleted</label>
            </div>
        </div>
    </form>
</template>

<script setup>
    import { reactive, watch } from 'vue';
    // import {Inertia} from '@inertiajs/inertia'; not working after inertia update to v1.0 replaced with below
    import { router } from '@inertiajs/vue3';
    import { debounce } from 'lodash';

    const filterForm = reactive({
        deleted: false,
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