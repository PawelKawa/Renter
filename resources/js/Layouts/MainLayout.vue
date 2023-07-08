<template>
  <div v-if="flashSuccess" class="flash">
    {{flashSuccess}}
  </div>
  <Link class="text-red-500" href="/listing">
    Listing
  </Link>&nbsp;
  <Link class="text-red-500" href="/listing/create">
     New listing
  </Link>&nbsp;
  <!-- <p>{{ timer }}</p> -->

  <slot />
</template>

<script setup>
import {ref} from 'vue'
import {computed} from 'vue'
import { usePage } from '@inertiajs/vue3'
const page = usePage()
const timer = ref(0)
const flashSuccess = computed( () => page.props.flash.success )

setInterval(() => timer.value++, 1000)
defineExpose({ timer })
</script>

<style scoped>
  .flash{
    background-color: green;
  }
</style>