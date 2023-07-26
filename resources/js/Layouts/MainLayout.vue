<template>
    <div class="bg-gray-200 dark:bg-gray-700">
        <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full">
            <div class="container mx-auto">
                <nav class="p-4 flex items-center justify-between">
                    <div class="flex gap-10">
                        <div class="text-lg font-medium">
                            <Link :href="route('listing.index')" class="text-black dark:text-white">Listings</Link>
                        </div>
                        <div>
                            <Link :href="route('test')">Test</Link>
                        </div>
                        <div v-if="user">
                            <Link :href="route('listing.create')" class="primary-btn">+ New Listing</Link>
                        </div>
                    </div>
                    <div class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center">
                        <Link :href="route('listing.index')"> Renter </Link>
                    </div>
                    <div v-if="user" class="flex gap-8 dark:text-white items-center">
                        <div>Hello {{user.name}} !</div>
                        <Link :href="route('logout')" class="primary-btn" method="delete" as="button">Logout</Link>
                    </div>
                    <div v-else class="dark:text-white">
                        <Link :href="route('login')">Sign-in</Link>
                    </div>
                </nav>
            </div>
        </header>
        <main class="container mx-auto p-4 min-h-screen">
            <div v-if="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-300 bg-green-200 p-2">
                {{ flashSuccess }}
            </div>
            <slot>Default</slot>
        </main>
    </div>
</template>

<script setup>
    // import { ref } from 'vue'
    import { computed } from 'vue'
    import { usePage } from '@inertiajs/vue3'

    const page = usePage()
    const flashSuccess = computed(() => page.props.flash.success)
    const user = computed(() => page.props.user)
</script>