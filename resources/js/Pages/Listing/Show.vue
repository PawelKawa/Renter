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
        <ListingAddress :listing="listing" class="text-red-200" />
      </Box>
      <Box>
        <template #header>
          Offer
        </template>
        Make an offer
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