<template>
    <NavWelcome />
  <Showcase :categories="categories" :faqs="faqs" />
    <Footer />
</template>

<script setup>
import NavWelcome from '@/components/NavWelcome.vue';
import Showcase from '@/components/Showcase.vue';
import Footer from '@/components/Footer.vue';

defineProps({
    categories: {
        type: Array,
        required: true
    },
     faqs: {
        type: Array,
        required: true
    }
})

</script>