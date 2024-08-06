<script setup>
import { ExclamationTriangleIcon } from "@heroicons/vue/24/outline";

defineProps({
  message: String
});
</script>

<template>
  <div v-show="message">
    <p class="flex items-center text-sm text-red-600 text-xs">
      <ExclamationTriangleIcon class="size-4 mr-1" />
      {{ message }}
    </p>
  </div>
</template>
