<template>
  <div v-if="page.props.flash.success" class="flash">
    {{page.props.flash.success}}
  </div>
  <Link class="text-red-500" href="/">
     Main page
  </Link>&nbsp;
  <Link class="text-red-500" href="/listing">
    Go to Listings page
  </Link>&nbsp;
  <p>{{ timer }}</p>
    
  <slot />
</template>

<script setup>
import {ref} from 'vue'
import { usePage } from '@inertiajs/vue3'
const page = usePage()
const timer = ref(0)
setInterval(() => timer.value++, 1000)
defineExpose({ timer })
</script>

<style scoped>
  .flash{
    background-color: green;
  }
</style>