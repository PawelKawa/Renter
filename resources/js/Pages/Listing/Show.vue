<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center w-full">
            <div class="w-full text-center text-gray-500">no images</div>
        </Box>
        <div class="md:col-span-5 flex flex-col gap-4">
            <Box>
                <template #header>
                    Basic info
                </template>
                <Price :price="listing.price" class="text-2xl" />
                <ListingSpace :listing="listing" class="text-xl" />
                <ListingAddress :listing="listing" class="dark:text-red-200" />
            </Box>
            <Box>
                <template #header>
                    Monthly Payment
                </template>
                <div>
                    <label class="label">Deposit</label>
                    <input type="number" class="text-black">
                    <label class="label">Interest rate (2.5%)</label>
                    <input type="range" min="0.1" max="30" step="0.1"
                        class="w-full h-4 bg-gray-700 rounded-lg appearance-none cursor-pointer dark:bg-gray-100" />

                    <label class="label">Duration (25 years)</label>
                    <input type="range" min="1" max="35" step="1"
                        class="w-full h-4 bg-gray-700 rounded-lg appearance-none cursor-pointer dark:bg-gray-100" />

                    <div class="text-gray-600 dark:text-gray-300 mt-2">
                        <div class="text-gray-400">Your monthly payment</div>
                        <Price :price="500" class="text-3xl" />
                    </div>
                </div>
            </Box>
        </div>
    </div>
</template>

<script setup>
    import Price from '@/Components/Price.vue'
    import ListingSpace from '@/Components/ListingSpace.vue'
    import ListingAddress from '@/Components/ListingAddress.vue'
    import Box from '@/Components/UI/Box.vue'
    defineProps({
        listing: Object,
    })
</script>

<script>
    import MainLayout from '@/Layouts/MainLayout.vue'
    export default {
        layout: MainLayout,
    }
</script>