<template>
  <span>
    {{ formatedPrice }}
  </span>
</template>

<script setup>
import {computed} from 'vue'
const props = defineProps({
    price: [Number, String],
})
const formatedPrice = computed(
    () => Number(props.price).toLocaleString('en-GB', {
        style: 'currency',
        currency: 'GBP',
        maximumFractionDigits: 2,
    }),
)
</script>