<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  href: String
});

</script>

<template>
  <Link :href="href"
        class="text-orange-500 hover:text-gray-600 focus:outline-none focus:text-gray-600 font-heading tracking-wide font-bold transition duration-150 ease-in-out">
    <slot />
  </Link>
</template>
