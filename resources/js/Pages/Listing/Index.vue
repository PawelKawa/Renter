<template>
  <Filters />
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <Box v-for="listing in listings.data" :key="listing.id">
      <Link :href="route('listing.show', listing.id)">
      <div>
          <Price :price="listing.price" class="text-2xl" />
          <ListingSpace :listing="listing" class="text-xl" /> 
          <ListingAddress :listing="listing" class="dark:text-red-200" />
        </div>
        <div>
          <Link :href="route('listing.edit', listing.id)">Edit</Link>
        </div>
        <div>
          <Link :href="route('listing.destroy', listing.id)" method="delete" as="button">Delete</Link>
        </div>
      </Link>
    </Box>
  </div>
  <div v-if="listings.data.length" class="w-full flex justify-center mt-8 mb-4">
    <Pagination :links="listings.links" />
  </div>
</template>

<script setup>
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import Filters from '@/Components/UI/Filters.vue'

defineProps({
    listings: Object,
})

</script>
