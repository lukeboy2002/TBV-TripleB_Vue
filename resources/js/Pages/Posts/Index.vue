<template>
  <AppLayout title="Posts">
    <template #hero>
      <img alt="blog"
           class="absolute inset-0 w-full h-124 object-cover"
           src="/assets/blog.jpg"
      />
      <div class="absolute h-124 inset-0 flex flex-col items-center justify-center">
        <h3 class="text-orange-500 font-heading font-semibold tracking-wide md:text-2xl uppercase">
          Blog
        </h3>
        <h1 class="text-5xl font-heading font-black tracking-wider uppercase text-white">
          TBV-TripleB Blog
        </h1>
      </div>
    </template>
    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3">
      <CardBlogPost v-for="post in posts.data" :key="post.id">
        <header>
          <img :src="post.image"
               alt="{{ post.title }}"
               class="h-48 w-full object-cover object-top my-6"
          />
          <LinkDefault :href="route('posts.show', post.id)" class="text-xl">
            {{ post.title }}
          </LinkDefault>
        </header>
        <main>
          <div class="flex justify-between items-center space-y-2 text-xs">
            <div>Categroy</div>
            <div>Likes</div>
          </div>
          <div class="flex justify-between items-center uppercase text-sm text-gray-500">

            <div class="flex space-x-4 ">
              <div>BY <span class="text-orange-500 font-semibold">{{ post.user.username }}</span></div>
              <div>{{ formattedDate(post) }}</div>
            </div>
            <div>
              Comment(s)
            </div>
          </div>

          <p class="mb-5 whitespace-pre-wrap font-light text-gray-700 dark:text-gray-50">
            {{ getShortBody(post.body) }}
          </p>
        </main>
        <footer class="flex justify-end">
          <Link :href="route('posts.show', post.id)"
                class="inline-flex items-center text-orange-500 hover:text-gray-600 focus:outline-none focus:text-gray-600 transition duration-150 ease-in-out"
          >
            Read More
            <ArrowRightCircleIcon class="ml-1 size-4" />
          </Link>
        </footer>
      </CardBlogPost>
    </div>
    <Pagination :meta="posts.meta" class="mt-4" />
  </AppLayout>
</template>
<script lang="ts" setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CardBlogPost from "@/Components/CardBlogPost.vue";
import Pagination from "@/Components/Pagination.vue";
import LinkDefault from "@/Components/LinkDefault.vue";

import { Link } from "@inertiajs/vue3";
import { ArrowRightCircleIcon } from "@heroicons/vue/24/outline";
import { relativeDate } from "@/Utilities/date.js";

defineProps(["posts"]);

const formattedDate = (post) => relativeDate(post.created_at);

const getShortBody = (body) => {
  const maxLength = 400; // You can adjust the length as needed
  if (body.length <= maxLength) {
    return body;
  }
  return body.substring(0, maxLength) + "...";
};
</script>