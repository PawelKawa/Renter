<template>
    <div class="flex gap-1">
        <Link v-for="(link, index) in links" :key="index" :href="link.url" class="py-2 px-4 rounded-md"
            :class="{'bg-indigo-800 dark:bg-indigo-400 text-gray' :link.active}" v-html="link.label">
        </Link>
    </div>
</template>

<script setup>
    defineProps({ links: Array })
</script>