<script setup>
defineProps({
  type: {
    type: String,
    default: "submit"
  }
});
</script>

<template>
  <button :type="type"
          class="inline-flex items-center px-1 py-1 border rounded-md focus:bg-orange-700 focus:outline-none transition ease-in-out duration-150">
    <slot />
  </button>
</template>
