<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  href: String,
  active: Boolean
});

const classes = computed(() => {
  return props.active
    ? "inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 uppercase text-orange-500 focus:outline-none transition duration-150 ease-in-out"
    : "inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 uppercase text-gray-400 hover:text-orange-500 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out";
});
</script>

<template>
  <Link :class="classes" :href="href">
    <slot />
  </Link>
</template>
