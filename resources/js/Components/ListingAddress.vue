<template>
  <div>
    {{ listing.street_nr }}
    {{ listing.street }}
    {{ listing.city }}
  </div>
</template>
  
<script setup>
defineProps({
    listing: Object,
})
</script>
  
