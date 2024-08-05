<template>
  <Article class="border border-gray-200">
    <header class="flex justify-between items-center mb-2 p-2">
      <div class="flex items-center">
        <div class="inline-flex items-center space-x-2 mr-3 font-semibold text-sm text-gray-900 uppercase">
          <img
            :src="comment.user.profile_photo_url"
            alt=" {{ comment.user.username }}"
            class="rounded-full shadow-lg size-8"
          />
          <p class="text-orange-500 font-bold"> {{ comment.user.username }} </p>

        </div>
        <p class="text-xs text-gray-600 dark:text-gray-400">
          {{ relativeDate(comment.created_at) }}
        </p>
      </div>
      <div class="text-sm text-gray-500 dark:text-gray-400 flex items-center space-x-1">
        <div class="text-xs">10</div>
        <HeartIcon class="size-3" />
        <div>likes</div>
      </div>
    </header>
    <main class="break-words rounded-lg p-3 text-sm font-normal italic text-gray-500">
      {{ comment.body }}
    </main>
    <footer class="flex justify-end items-center text-xs">
      footer
    </footer>
  </Article>
</template>
<script setup>
import Article from "@/Components/Article.vue";

import { HeartIcon } from "@heroicons/vue/24/outline/index.js";
import { relativeDate } from "@/Utilities/date.js";

defineProps(["comment"]);
</script>