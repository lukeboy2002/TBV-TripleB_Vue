<script setup>
import Banner from "@/Components/Banner.vue";
import Footer from "@/Components/Footer.vue";

import { Head } from "@inertiajs/vue3";
import MainNavigation from "@/Components/MainNavigation.vue";
import ModalWrapper from "@/Components/ModalWrapper.vue";

defineProps({
  title: String
});

</script>

<template>
  <div class="flex justify-between flex-col h-dvh">
    <Head :title="title" />

    <div>
      <Banner />
      <MainNavigation />
      <section class="px-0">
        <div v-if="$slots.hero"
             class="relative h-124">
          <slot name="hero" />
        </div>

        <div v-if="$slots.side" class="mx-auto flex max-w-7xl flex-wrap px-4 sm:px-6 lg:px-8">
          <main class="flex w-full flex-col px-3 md:w-3/4">
            <slot />
          </main>
          <aside class="flex w-full flex-col px-3 md:w-1/4">
            <slot name="side" />
          </aside>
        </div>

        <div v-else class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <slot />
        </div>

      </section>
    </div>

    <Footer />

    <ModalWrapper />
  </div>
</template>
