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
      <div class="text-sm text-gray-500 dark:text-gray-400 flex items-center space-x-4">
        <div class="flex items-center space-x-1">
          <HeartIcon class="size-3" />
          <div>{{ comment.likes_count }}</div>
        </div>
      </div>
    </header>
    <main class="p-3 prose prose-sm max-w-none" v-html="comment.html"></main>

    <footer class="flex justify-between items-center text-xs ml-4 space-x-1 empty:hidden">
      <div v-if="$page.props.auth.user" class="flex items-center justify-end space-x-6">
        <Link v-if="comment.can.like"
              :href="route('likes.store', ['comment', comment.id])"
              class="flex items-center space-x-2 text-green-700 hover:text-green-500 transition-colors"
              method="post" preserve-scroll>
          <HandThumbUpIcon class="size-4" />
          <span class="text-xs">like</span>
        </Link>
        <Link v-else :href="route('likes.destroy', ['comment', comment.id])"
              class="flex items-center space-x-2 text-red-700 hover:text-red-500 transition-colors"
              method="delete"
              preserve-scroll>
          <HandThumbDownIcon class="size-4" />
          <span class="text-xs">unlike</span>
        </Link>
      </div>
      <div class="flex space-x-2">
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
      </div>
    </footer>
  </Article>
</template>
<script setup>
import Article from "@/Components/Article.vue";
import ButtonIcon from "@/Components/ButtonIcon.vue";

import { HeartIcon, PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/outline/index.js";
import { relativeDate } from "@/Utilities/date.js";
import { HandThumbDownIcon, HandThumbUpIcon } from "@heroicons/vue/20/solid/index.js";
import { Link } from "@inertiajs/vue3";

const props = defineProps(["comment"]);

const emit = defineEmits(["edit", "delete"]);


</script>