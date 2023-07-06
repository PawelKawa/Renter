<template>
    <div>
      {{ listing.street }}
      {{ listing.street_nr }}
      {{ listing.city }}
      {{ listing.price }}
    </div>
  </template>
  
  <script setup>
      defineProps({
          listing: Object
      })
  </script>
  
