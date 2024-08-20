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
    <div>
      <div class="md:flex sm:justify-end md:justify-between items-center mt-3  py-1">
        <menu class="hidden md:flex justify-between items-center overflow-x-auto">
          <li>
            <LinkCategory :filled="! selectedCategory" :href="route('posts.index', { query: searchForm.query })">
              All Posts
            </LinkCategory>
          </li>
          <li v-for="category in categories" :key="category.id">
            <LinkCategory :filled="category.id === selectedCategory?.id"
                          :href="route('posts.index', { category: category.slug, query: searchForm.query })"
            >
              {{ category.name }}
            </LinkCategory>
          </li>
        </menu>

        <form class="w-full md:w-1/4" @submit.prevent="search">
          <label class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white"
                 for="query">Search</label>
          <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <MagnifyingGlassIcon class="size-4 text-orange-500" />
            </div>
            <TextInput id="query"
                       v-model="searchForm.query"
                       class="block w-full p-2 ps-10 text-sm"
                       placeholder="Search ..."
                       type="search" />
            <div class="absolute flex end-2.5 bottom-1.5">
              <ButtonIcon class="bg-orange-500" type="submit">
                <MagnifyingGlassIcon class="size-4 text-white" />
              </ButtonIcon>
              <ButtonIcon v-if="searchForm.query"
                          class="bg-red-500"
                          @click="clearSearch">
                <XCircleIcon class="size-4 text-white" />
              </ButtonIcon>
            </div>
          </div>
          <!--          <ButtonDanger v-if="searchForm.query" @click="clearSearch">Clear</ButtonDanger>-->
        </form>

      </div>
      <p v-if="selectedCategory" class="hidden md:block mt-1 text-xs text-orange-500 italic empty:hidden">
        {{ selectedCategory.description }}
      </p>
    </div>
    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3">
      <CardBlogPost v-for="post in posts.data" :key="post.id">
        <header>
          <img :alt="post.title"
               :src="post.image"
               class="h-48 w-full object-cover object-top my-6"
          />
          <LinkDefault :href="post.routes.show" class="text-xl">
            {{ post.title }}
          </LinkDefault>
        </header>
        <main>
          <div class="flex justify-between items-center space-y-2 text-xs mb-2">
            <a
              :href="route('posts.index', { category: post.category.slug })"
              class="bg-orange-100 text-orange-800 border hover:border-orange-500 focus:outline-none focus:border-orange-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{ post.category.name
              }}
            </a>
            <div>{{ post.likes_count }} Likes</div>
          </div>
          <div class="flex justify-between items-center uppercase text-sm text-gray-500">

            <div class="flex space-x-4 ">
              <div>BY <span class="text-orange-500 font-semibold">{{ post.user.username }}</span></div>
              <div>{{ formattedDate(post) }}</div>
            </div>
            <div>
              {{ post.comments_count }} Comment(s)
            </div>
          </div>

          <p class="mb-5 whitespace-pre-wrap font-light text-gray-700 dark:text-gray-50"
             v-html="getShortBody(post.html)">
          </p>
        </main>
        <footer class="flex justify-end">
          <Link :href="post.routes.show"
                class="inline-flex items-center text-orange-500 hover:text-gray-600 focus:outline-none focus:text-gray-600 transition duration-150 ease-in-out"
          >
            Read More
            <ArrowRightCircleIcon class="ml-1 size-4" />
          </Link>
        </footer>
      </CardBlogPost>
    </div>
    <Pagination :meta="posts.meta"
                :only="['posts']"
                class="mt-4"
    />
  </AppLayout>
</template>
<script lang="ts" setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CardBlogPost from "@/Components/CardBlogPost.vue";
import Pagination from "@/Components/Pagination.vue";
import LinkDefault from "@/Components/LinkDefault.vue";

import { Link, useForm, usePage } from "@inertiajs/vue3";
import { ArrowRightCircleIcon, MagnifyingGlassIcon, XCircleIcon } from "@heroicons/vue/24/outline";
import { relativeDate } from "@/Utilities/date.js";
import LinkCategory from "@/Components/LinkCategory.vue";
import TextInput from "@/Components/form/TextInput.vue";
import ButtonIcon from "@/Components/ButtonIcon.vue";

const props = defineProps(["posts", "categories", "selectedCategory", "query"]);

const formattedDate = (post) => relativeDate(post.published_at);

const getShortBody = (html) => {
  const maxLength = 200; // You can adjust the length as needed
  if (html.length <= maxLength) {
    return html;
  }
  return html.substring(0, maxLength) + "...";
};

const searchForm = useForm({
  query: props.query,
  page: 1
});

const page = usePage();
const search = () => searchForm.get(page.url);

const clearSearch = () => {
  searchForm.query = "";
  search();
};

</script>