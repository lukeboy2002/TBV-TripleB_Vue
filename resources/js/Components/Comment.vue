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
    <main class="p-3 prose prose-sm max-w-none" v-html="comment.html"></main>

    <footer class="flex justify-end items-center text-xs space-x-1 empty:hidden">
      <form v-if="comment.can?.update" @submit.prevent="$emit('edit', comment.id)">
        <ButtonIcon
          class="text-green-500 border-green-500 hover:bg-green-500 hover:text-white focus:bg-green-500 focus:text-white">
          <PencilSquareIcon class="size-4" />
        </ButtonIcon>
      </form>
      <form v-if="comment.can?.delete" @submit.prevent="$emit('delete', comment.id)">
        <ButtonIcon
          class="text-red-500 border-red-500 hover:bg-red-500 hover:text-white focus:bg-red-500 focus:text-white">
          <TrashIcon class="size-4" />
        </ButtonIcon>
      </form>
    </footer>
  </Article>
</template>
<script setup>
import Article from "@/Components/Article.vue";
import ButtonIcon from "@/Components/ButtonIcon.vue";

import { HeartIcon, PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/outline/index.js";
import { relativeDate } from "@/Utilities/date.js";

const props = defineProps(["comment"]);

const emit = defineEmits(["edit", "delete"]);


</script>