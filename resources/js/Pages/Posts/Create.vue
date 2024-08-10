<template>
  <AppLayout title="Create a Post">
    <template #hero>
      <img alt="blog"
           class="absolute inset-0 w-full h-124 object-cover"
           src="/assets/blog.jpg"
      />
      <div class="absolute h-124 inset-0 flex flex-col items-center justify-center">
        <h3 class="text-orange-500 font-heading font-semibold tracking-wide md:text-2xl uppercase">
          Create a blogpost
        </h3>
        <h1 class="text-5xl font-heading font-black tracking-wider uppercase text-white">
          TBV-TripleB Blog
        </h1>
      </div>
    </template>
    <form class="space-y-4 my-6 border border-orange-500 shadow-lg rounded-lg p-4"
          @submit.prevent="createPost">
      <div>
        <input id="image" type="file" @input="change" />
        <InputError :message="form.errors.image" class="mt-1" />
      </div>

      <div class="flex justify-between items-center space-x-4">
        <div class="w-1/2">
          <InputLabel class="sr-only" for="title"> Title</InputLabel>
          <TextInput id="title" v-model="form.title" class="w-full" placeholder="Title" />
          <InputError :message="form.errors.title" class="mt-1" />
        </div>
        <div class="w-1/2">
          Topics
        </div>
      </div>
      <div>
        <InputLabel class="sr-only" for="body"> Title</InputLabel>
        <TextArea id="body" v-model="form.body" class="w-full" placeholder="Your post" rows="5" />
        <InputError :message="form.errors.body" class="mt-1" />
      </div>
      <div class="flex justify-between items-center space-x-4">
        <div class="w-1/2">
          <VueDatePicker v-model="form.published_at" :enable-time-picker="false" auto-apply />

          <!--          <VueDatePicker v-model="form.published_at"></VueDatePicker>-->
        </div>
        <div class="w-1/2">
          <label class="inline-flex items-center me-5 cursor-pointer">
            <input v-model="form.featured"
                   class="sr-only peer"
                   type="checkbox"
                   value=""
            >
            <div
              class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-orange-300 dark:peer-focus:ring-orange-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-orange-500"></div>
            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">This is featured post</span>
          </label>
        </div>
      </div>

      <div class="flex justify-end items-center mt-2">
        <ButtonPrimary>Create Post</ButtonPrimary>
      </div>
    </form>
  </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from "@/Components/form/InputLabel.vue";
import TextInput from "@/Components/form/TextInput.vue";
import InputError from "@/Components/form/InputError.vue";
import TextArea from "@/Components/form/TextArea.vue";
import ButtonPrimary from "@/Components/ButtonPrimary.vue";

import { useForm } from "@inertiajs/vue3";

import { ref } from "vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

const date = ref();

const change = (e) => {
  form.image = e.target.files[0];
};

const form = useForm({
  title: null,
  body: null,
  image: null,
  published_at: null,
  featured: false
});

const createPost = () => form.post(route("posts.store"));
</script>

<style>
.dp__theme_light {
  --dp-primary-color: rgb(249 115 22);
  --dp-border-color-hover: rgb(249 115 22);
  --dp-border-color-focus: rgb(249 115 22);
}
</style>