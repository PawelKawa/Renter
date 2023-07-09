<template>
  <p class="text-3xl font-bold underline">Main page</p>
  <p>The message is: {{ message }}</p>
  <p>{{ y }}</p>
  <button class="mr-2 border" @click="plus">add</button>
  <button class="border" @click="x--">subtract</button>
</template>

<script setup>
// import MainLayout from '../../Layouts/MainLayout.vue'
// import MainLayout from '@/Layouts/MainLayout.vue'
import {ref, computed} from 'vue'
const x = ref(0)
const y = computed( () => x.value * 2 )
const plus = () => x.value++
// defineProps(['message'])
defineProps({
    //message is writen in backend indexController
    message: String,
})

</script>

<!-- Loading something like presistent Layouts and thanks to that timer is not restarting when swaping pages. -->
<script>
import MainLayout from '@/Layouts/MainLayout.vue'
export default {
    layout: MainLayout,
}
</script>