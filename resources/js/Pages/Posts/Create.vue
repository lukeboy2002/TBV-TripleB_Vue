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
        Image
        <!--        <InputLabel for="image"> Featured Image</InputLabel>-->
        <!--        <TextInput id="image" v-model="form.image" type="file" />-->
        <!--        <InputError :message="form.errors.image" class="mt-1" />-->
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
          Published
        </div>
        <div class="w-1/2">
          Featured
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

const form = useForm({
  title: "",
  body: ""
});

const createPost = () => form.post(route("posts.store"));
</script>