<template>
  <div class="">
    <Component
      v-for="(link, index) in links"
      v-if="link"
      :key="index"
      :is="link.url ? Link : 'span'"
      :href="link.url"
      v-html="link.label"
      :class="[
        '',
        link.url 
          ? link.active
            ? ''
            : ''
          : '',
        ''
      ]"
    />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  links: {
    type: Array,
    required: true,
  },
});
</script>
