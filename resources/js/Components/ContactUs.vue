<template>
  <div class="flex items-center space-x-2">
    <EnvelopeIcon class="size-10 text-orange-500" />
    <div class="leading-3">
      <h3 class="text-uppercase text-sm font-black text-orange-500">
        Contact US
      </h3>
      <a class="text-xs text-gray-400 focus:underline focus:outline-none hover:text-orange-500"
         href="mailto:info@tbv-tripleb.nl"
      >
        info @tbv-tripleb.nl
      </a>
    </div>
  </div>

</template>

<script setup>
import { EnvelopeIcon } from "@heroicons/vue/24/outline";
</script>
