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
                    <div class="flex items-center mt-2">
                        <label class="label">Deposit</label>
                        <p class="relative left-8 text-black">£</p>
                        <input v-model.number="deposit" type="number" min="1" :max="listing.price-10000"
                            class="text-black ml-4 pl-6 w-full input">
                        </div>
                    <div class="mt-2">
                        <label class="label">Interest rate ({{intrestRate}}%)</label>
                        <input v-model.number="intrestRate" type="range" min="0.1" max="30" step="0.1"
                            class="w-full h-4 bg-gray-700 rounded-lg appearance-none cursor-pointer dark:bg-gray-100" />
                    </div>
                    <div class="mt-2">
                        <label class="label">Duration ({{duration}}years)</label>
                        <input v-model.number="duration" type="range" min="1" max="35" step="1"
                            class="w-full h-4 bg-gray-700 rounded-lg appearance-none cursor-pointer dark:bg-gray-100" />
                    </div>

                    <div class="text-gray-600 dark:text-gray-300 mt-2">
                        <div class="text-gray-400">Your monthly payment</div>
                        <Price :price="monthlyPayment" class="text-3xl" />
                    </div>
                    <div class="text-gray-600 dark:text-gray-300 mt-2">
                        <div class="text-gray-400">Total paid for property</div>
                        <Price :price="totalPaid" class="text-3xl" />
                    </div>
                    <div class="text-gray-600 dark:text-gray-300 mt-2">
                        <div class="text-gray-400">Total intrest paid on the mortgage</div>
                        <Price :price="totalIntrest" class="text-3xl" />
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
    import { ref, computed } from 'vue'

    const props = defineProps({
        listing: Object,
    })
    const deposit = ref(10000)
    const intrestRate = ref(2.5)
    const duration = ref(25)
    const monthlyPayment = computed(() => {
        const principle = props.listing.price - deposit.value
        const monthlyInterest = intrestRate.value / 100 / 12
        const numberOfPaymentMonths = duration.value * 12
        return principle * monthlyInterest * (Math.pow(1 + monthlyInterest, numberOfPaymentMonths)) / (Math.pow(1 + monthlyInterest, numberOfPaymentMonths) - 1)
    })
    const totalPaid = computed(()=>{
        return duration.value * 12 * monthlyPayment.value
    })
    const totalIntrest = computed(()=>{
        return totalPaid.value - props.listing.price - deposit.value
    })

</script>

<script>
    import MainLayout from '@/Layouts/MainLayout.vue'
    export default {
        layout: MainLayout,
    }
</script>