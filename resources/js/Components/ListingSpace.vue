<template>
  <div>
    <span class="font-bold">{{ listing.beds }}</span>  beds 
    <span class="dark:text-red-200 mx-2">|</span> 
    <span class="font-bold">{{ listing.baths }}</span> baths
    <span class="dark:text-red-200 mx-2">|</span> 
    <span class="font-bold">{{ listing.area }}</span> m^2
  </div>
</template>

<script setup>
defineProps({
    listing: Object,
})
</script>