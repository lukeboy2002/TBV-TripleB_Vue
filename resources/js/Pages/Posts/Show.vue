<template>
  <Head>
    <link :href="post.routes.show" rel="canonical" />
  </Head>
  <AppLayout :title="post.title">
    <template #hero>
      <img :alt="post.title"
           :src='"/" +post.image'
           class="absolute inset-0 w-full h-124 object-cover"
      />
      <div class="absolute h-124 inset-0 flex flex-col items-center justify-center">
        <h3 class="text-orange-500 font-heading font-semibold tracking-wide md:text-4xl uppercase">
          {{ post.title }}
        </h3>
      </div>
    </template>

    <Article class="shadow-xl pb-8">
      <header class="mb-2">
        <div class="flex justify-between items-center text-gray-500">
          <div class="flex items-center space-x-4 mt-6">
            <a
              :href="route('posts.index', { category: post.category.slug })"
              class="bg-orange-100 font-semibold uppercase text-orange-800 border hover:border-orange-500 focus:outline-none focus:border-orange-500 text-xs me-2 px-2.5 py-0.5 rounded">
              {{ post.category.name }}
            </a>
          </div>
          <div>
            <div class="flex space-x-4 uppercase">
              <div>BY <span class="text-orange-500 font-semibold">{{ post.user.username }}</span></div>
              <div>{{ formattedDate }}</div>
            </div>
          </div>
        </div>
        <div class="flex justify-end items-center text-xs">
          <HeartIcon class="mr-1 size-3" />
          <div>
            {{ post.likes_count }} Likes
          </div>
        </div>
      </header>
      <main class="prose prose-sm max-w-none" v-html="post.html">
      </main>
      <footer>
        <div v-if="$page.props.auth.user" class="flex items-center justify-end space-x-6">
          <Link v-if="post.can.like"
                :href="route('likes.store', ['post', post.id])"
                class="flex items-center space-x-2 text-green-700 hover:text-green-500 transition-colors"
                method="post" preserve-scroll>
            <HandThumbUpIcon class="size-4" />
            <span class="text-xs">like post</span>
          </Link>
          <Link v-else
                :href="route('likes.destroy', ['post', post.id])"
                class="flex items-center space-x-2 text-red-700 hover:text-red-500 transition-colors"
                method="delete"
                preserve-scroll>
            <HandThumbDownIcon class="size-4" />
            <span class="text-xs">unlike post</span>
          </Link>
        </div>
      </footer>
    </Article>

    <div class="ml-6 pt-4">
      <h3 class="text-xl font-black text-orange-500 tracking-widest border-l-4 border-orange-500 pl-2 mb-4">
        Comments
      </h3>
      <form v-if="$page.props.auth.user" class="mt-4"
            @submit.prevent="() => commentIdBeingEdited ? updateComment() : addComment()">
        <div>
          <InputLabel class="sr-only" for="body">Comment</InputLabel>

          <MarkdownEditor id="body" ref="commentTextAreaRef" v-model="commentForm.body" editorClass="!min-h-[160px]"
                          placeholder="Leave a comment" />
          <InputError :message="commentForm.errors.body"
                      class="mt-1"
          />
        </div>

        <div class="mt-3 flex justify-end space-x-2">
          <ButtonPrimary :disabled="commentForm.processing" type="submit"
                         v-text="commentIdBeingEdited ? 'Update Comment' : 'Add Comment'"></ButtonPrimary>
          <ButtonSecondary v-if="commentIdBeingEdited"
                           @click="cancelEditComment">
            Cancel
          </ButtonSecondary>
        </div>
      </form>


      <div v-else>
        <div class="flex justify-end items-center space-x-1">
          <p class="text-gray-900 dark:text-white text-xs">Only registered users can leave a comment.</p>
          <LinkReversed :href="route('login')" class="text-xs"> Login</LinkReversed>
        </div>
      </div>

      <div v-for="comment in comments.data" :key="comment.id">
        <Comment :comment="comment"
                 @delete="deleteComment"
                 @edit="editComment" />
      </div>
      <Pagination :meta="comments.meta"
                  :only="['comments']"
                  class="mt-4"
      />
    </div>
    <template #side>
      <h3 class="text-orange-500 font-bold text-xl uppercase">Categrories</h3>

      <menu class="ml-2 mt-3 space-y-3">
        <li v-for="category in categories" :key="category.id">
          <LinkDefault :href="route('posts.index', { category: category.slug })">
            {{ category.name }}
          </LinkDefault>
        </li>
      </menu>

    </template>
  </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Article from "@/Components/Article.vue";
import Comment from "@/Components/Comment.vue";
import Pagination from "@/Components/Pagination.vue";
import InputLabel from "@/Components/form/InputLabel.vue";
import InputError from "@/Components/form/InputError.vue";
import ButtonPrimary from "@/Components/ButtonPrimary.vue";
import ButtonSecondary from "@/Components/ButtonSecondary.vue";
import MarkdownEditor from "@/Components/MarkdownEditor.vue";
import LinkDefault from "@/Components/LinkDefault.vue";
import LinkReversed from "@/Components/LinkReversed.vue";

import { HeartIcon } from "@heroicons/vue/24/outline";
import { HandThumbUpIcon, HandThumbDownIcon } from "@heroicons/vue/20/solid";
import { relativeDate } from "@/Utilities/date.js";
import { computed, ref } from "vue";
import { router, useForm, Head, Link } from "@inertiajs/vue3";
import { useConfirm } from "@/Utilities/Composables/useConfirm.js";

const props = defineProps(["post", "categories", "comments"]);

const formattedDate = computed(() => relativeDate(props.post.published_at));

const commentForm = useForm({
  body: ""
});

const commentTextAreaRef = ref(null);
const commentIdBeingEdited = ref(null);
const commentBeingEdited = computed(() => props.comments.data.find(comment => comment.id === commentIdBeingEdited.value));

const editComment = (commentId) => {
  commentIdBeingEdited.value = commentId;
  commentForm.body = commentBeingEdited.value?.body;
  commentTextAreaRef.value?.focus();
};

const cancelEditComment = () => {
  commentIdBeingEdited.value = null;
  commentForm.reset();
};

const addComment = () => commentForm.post(route("posts.comments.store", props.post.id), {
  preserveScroll: true,
  onSuccess: () => commentForm.reset()
});

const { confirmation } = useConfirm();

const updateComment = async () => {
  if (!await confirmation("Are you sure you want to update this comment?")) {
    commentTextAreaRef.value?.focus();
    return;
  }
  commentForm.put(route("comments.update", {
    comment: commentIdBeingEdited.value,
    page: props.comments.meta.current_page
  }), {
    preserveScroll: true,
    onSuccess: cancelEditComment
  });
};

const deleteComment = async (commentId) => {
  if (!await confirmation("Are you sure you want to delete this comment?")) {
    return;
  }
  router.delete(
    route("comments.destroy", {
      comment: commentId,
      page: props.comments.data.length > 1
        ? props.comments.meta.current_page
        : Math.max(props.comments.meta.current_page - 1, 1)
    }),
    {
      preserveScroll: true
    }
  );
};

</script>