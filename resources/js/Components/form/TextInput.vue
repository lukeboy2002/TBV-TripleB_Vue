<script setup>
import { onMounted, ref } from "vue";

defineProps({
  modelValue: String
});

defineEmits(["update:modelValue"]);

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
    :value="modelValue"
    class="bg-gray-50 border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm"
    @input="$emit('update:modelValue', $event.target.value)"
  >
</template>
