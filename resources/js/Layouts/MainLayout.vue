<template>
  <div v-if="flashSuccess" class="flash">
    {{flashSuccess}}
  </div>
  <Link class="text-red-500" href="/">
     Main page
  </Link>&nbsp;
  <Link class="text-red-500" href="/listing">
    Go to Listings page
  </Link>&nbsp;
  <p>{{ timer }}</p>
    <p>{{y}}</p>
    <button class="mr-2 border" @click="plus">add</button>
    <button class="border" @click="x--">subtract</button>
  <slot />
</template>

<script setup>
import {ref} from 'vue'
import {computed} from 'vue'
import { usePage } from '@inertiajs/vue3'
const page = usePage()
const timer = ref(0)
const flashSuccess = computed( () => page.props.flash.success )
const x = ref(0);
const y = computed( () => x.value * 2 )
const plus = () => x.value++

setInterval(() => timer.value++, 1000)
defineExpose({ timer })
</script>

<style scoped>
  .flash{
    background-color: green;
  }
</style>