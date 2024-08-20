<template>
  <Link
    :class="{ '!bg-orange-500 !text-orange-50': filled }"
    :href="href"
    class="bg-orange-100 text-orange-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded"
  >
    <slot></slot>
  </Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  href: {
    required: true
  },
  filled: {
    default: false
  }
});
</script>