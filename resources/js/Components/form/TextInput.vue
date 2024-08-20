<script setup>
import { onMounted, ref } from "vue";

const model = defineModel();

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute("autofocus")) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <input
    ref="input"
    v-model="model"
    class="bg-gray-50 border border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-lg shadow-sm"
  >
</template>
