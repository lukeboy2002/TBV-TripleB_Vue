<template>
  <div class="flex items-center justify-between border-t border-orange-500/30 py-3">
    <div class="flex flex-1 justify-between lg:hidden">
      <Link :href="previousUrl" :only="only"
            class="inline-flex items-center rounded-md bg-orange-500 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-orange-700 focus:outline-none focus:bg-orange-700 transition duration-150 ease-in-out">
        Previous
      </Link>
      <Link :href="nextUrl" :only="only"
            class="inline-flex items-center rounded-md bg-orange-500 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-orange-700 focus:outline-none focus:bg-orange-700 transition duration-150 ease-in-out">
        Next
      </Link>
    </div>
    <div
      class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-between"
    >
      <div>
        <p class="text-xs text-gray-900">
          Showing
          {{ " " }}
          <span class="font-medium font-semibold text-orange-500">{{
              meta.from
            }}</span>
          {{ " " }}
          to
          {{ " " }}
          <span class="font-medium font-semibold text-orange-500">{{
              meta.to
            }}</span>
          {{ " " }}
          of
          {{ " " }}
          <span class="font-medium font-semibold text-orange-500">{{
              meta.total
            }}</span>
          {{ " " }}
          results
        </p>
      </div>
      <div>
        <nav aria-label="Pagination"
             class="isolate inline-flex -space-x-px rounded-md shadow-sm"
        >
          <Link v-for="link in meta.links"
                :class="{ 'z-10 bg-orange-500 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-500':
                            link.active,
                       'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:bg-gray-300 focus:outline-none':
                            !link.active,
                    }"
                :href="link.url"
                :only="only"
                class="relative inline-flex items-center px-3 py-2 text-xs first-of-type:rounded-l-md last-of-type:rounded-r-md"
                v-html="link.label"
          >
          </Link>
        </nav>
      </div>
    </div>
  </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
  meta: {
    type: Object,
    required: true
  },
  only: {
    type: Array,
    default: () => []
  }
});

const only = computed(() => props.only.length === 0 ? [] : [...props.only, "jetstream"]);
const previousUrl = computed(() => props.meta.links[0].url);
const nextUrl = computed(() => [...props.meta.links].reverse()[0].url);
</script>