<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  active: Boolean,
  href: String,
  as: String
});

const classes = computed(() => {
  return props.active
    ? "block w-full ps-3 pe-4 py-2 text-start text-base font-medium text-orange-500 focus:outline-none transition duration-150 ease-in-out"
    : "block w-full ps-3 pe-4 py-2 text-start text-base font-medium text-gray-400 hover:text-orange-500 focus:outline-none focus:text-orange-500 transition duration-150 ease-in-out";
});
</script>

<template>
  <div>
    <button v-if="as == 'button'" :class="classes" class="w-full text-start">
      <slot />
    </button>

    <Link v-else :class="classes" :href="href">
      <slot />
    </Link>
  </div>
</template>
