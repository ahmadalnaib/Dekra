<script setup>
    import { Link } from '@inertiajs/vue3'

    defineProps({
        pagination: Object
    })
</script>

<template>
    <nav class="relative flex justify-center gap-2">
        <template v-for="link in pagination.links" :key="link.label">
            <Link
                preserve-scroll
                :href="link.url ?? ''"
                class="flex items-center justify-center px-3 py-2 text-sm rounded-lg border border-green-300 text-green hover:bg-green-700 transition-colors"
                :class="{ 
                    'bg-green-800 text-white': link.active, 
                    '!bg-gray-300 !text-gray-500 cursor-not-allowed hover:!bg-gray-300': !link.url 
                }"
            >
                <span v-if="link.label.includes('Previous')">←</span>
                <span v-else-if="link.label.includes('Next')">→</span>
                <span v-else v-html="link.label"></span>
            </Link>
        </template>
    </nav>
</template>