<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  href: String
});

</script>

<template>
  <Link :href="href"
        class="text-gray-600 hover:text-orange-500 focus:outline-none focus:text-orange-500 font-heading tracking-wide font-bold uppercase transition duration-150 ease-in-out">
    <slot />
  </Link>
</template>
