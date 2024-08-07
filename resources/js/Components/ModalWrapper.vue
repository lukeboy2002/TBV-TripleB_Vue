<template>
  <ModalConfirmation :show="state.show">
    <template #title>
      {{ state.title }}
    </template>

    <template #content>
      {{ state.message }}
    </template>

    <template #footer>
      <ButtonSecondary ref="cancelButtonRef" @click="cancel">Cancel</ButtonSecondary>
      <ButtonPrimary class="ml-3" @click="confirm">Confirm</ButtonPrimary>
    </template>
  </ModalConfirmation>

</template>
<script setup>
import ModalConfirmation from "@/Components/ModalConfirmation.vue";
import ButtonSecondary from "@/Components/ButtonSecondary.vue";
import ButtonPrimary from "@/Components/ButtonPrimary.vue";

import { useConfirm } from "@/Utilities/Composables/useConfirm.js";
import { nextTick, ref, watchEffect } from "vue";

const { state, confirm, cancel } = useConfirm();
const cancelButtonRef = ref(null);
watchEffect(async () => {
  if (state.show) {
    await nextTick();
    cancelButtonRef.value?.$el.focus();
  }
});

</script>