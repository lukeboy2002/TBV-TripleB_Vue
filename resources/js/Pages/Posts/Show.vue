<template>
  <AppLayout :title="post.title">
    <template #hero>
      <img :src="post.image"
           alt="post.title"
           class="absolute inset-0 w-full h-124 object-cover"
      />
      <div class="absolute h-124 inset-0 flex flex-col items-center justify-center">
        <h3 class="text-orange-500 font-heading font-semibold tracking-wide md:text-4xl uppercase">
          {{ post.title }}
        </h3>
      </div>
    </template>

    <Article>
      <header class="flex justify-between items-center text-gray-500 mb-4">
        <div class="flex items-center space-x-4">
          <div class="text-orange-500 uppercase font-medium">
            Category
          </div>
        </div>
        <div>
          <div class="flex space-x-4 uppercase">
            <div>BY <span class="text-orange-500 font-semibold">{{ post.user.username }}</span></div>
            <div>{{ formattedDate }}</div>
          </div>
        </div>
      </header>
      <main class="text-gray-500 leading-7 whitespace-pre-wrap font-sans">
        {{ post.body }}
      </main>
      <footer class="flex justify-end items-center text-gray-500 text-xs">
        <HeartIcon class="mr-1 size-3" />
        <div>
          Like
        </div>

      </footer>
    </Article>

    <template #side>
      <h3 class="text-orange-500 font-bold text-xl">To be continued</h3>
    </template>

  </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Article from "@/Components/Article.vue";

import { HeartIcon } from "@heroicons/vue/24/outline";
import { relativeDate } from "@/Utilities/date.js";
import { computed } from "vue";

const props = defineProps(["post"]);

const formattedDate = computed(() => relativeDate(props.post.created_at));

</script>