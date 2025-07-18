<template>
    <Showcase :categories="categories" />
</template>

<script setup>
import Showcase from '@/components/Showcase.vue'

defineProps({
    categories: {
        type: Array,
        required: true
    }
})
</script>