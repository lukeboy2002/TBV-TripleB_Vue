<template>
  <div v-if="editor"
       class="bg-white rounded-md border-0 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-orange-500">
    <menu class="flex divide-x border-b">
      <li>
        <button :class="[editor.isActive('bold') ? 'bg-orange-500 text-white' : 'hover:bg-gray-200']"
                class="px-3 py-2 rounded-tl-lg"
                title="Bold"
                type="button"
                @click="editor.chain().focus().toggleBold().run()">
          <i class="ri-bold"></i>
        </button>
      </li>
      <li>
        <button :class="[editor.isActive('italic') ? 'bg-orange-500 text-white' : 'hover:bg-gray-200']"
                class="px-3 py-2"
                title="Italic"
                type="button"
                @click="editor.chain().focus().toggleItalic().run()">
          <i class="ri-italic"></i>
        </button>
      </li>
      <li>
        <button :class="[editor.isActive('strike') ? 'bg-orange-500 text-white' : 'hover:bg-gray-200']"
                class="px-3 py-2"
                title="Strikethrough"
                type="button"
                @click="editor.chain().focus().toggleStrike().run()">
          <i class="ri-strikethrough"></i>
        </button>
      </li>
      <li>
        <button :class="[editor.isActive('blockquote') ? 'bg-orange-500 text-white' : 'hover:bg-gray-200']"
                class="px-3 py-2"
                title="Blockquote"
                type="button"
                @click="editor.chain().focus().toggleBlockquote().run()">
          <i class="ri-double-quotes-l"></i>
        </button>
      </li>
      <li>
        <button :class="[editor.isActive('bulletList') ? 'bg-orange-500 text-white' : 'hover:bg-gray-200']"
                class="px-3 py-2"
                title="Bullet list"
                type="button"
                @click="() => editor.chain().focus().toggleBulletList().run()">
          <i class="ri-list-unordered"></i>
        </button>
      </li>
      <li>
        <button :class="[editor.isActive('orderedList') ? 'bg-orange-500 text-white' : 'hover:bg-gray-200']"
                class="px-3 py-2"
                title="Numeric list"
                type="button"
                @click="() => editor.chain().focus().toggleOrderedList().run()">
          <i class="ri-list-ordered"></i>
        </button>
      </li>
      <li>
        <button :class="[editor.isActive('orderedList') ? 'bg-orange-500 text-white' : 'hover:bg-gray-200']"
                class="px-3 py-2"
                title="Numeric list"
                type="button"
                @click="() => editor.chain().focus().toggleOrderedList().run()">
          <i class="ri-list-ordered"></i>
        </button>
      </li>
      <li>
        <button :class="[editor.isActive('link') ? 'bg-orange-500 text-white' : 'hover:bg-gray-200']"
                class="px-3 py-2"
                title="Add link"
                type="button"
                @click="promptUserForHref">
          <i class="ri-link"></i>
        </button>
      </li>
      <li>
        <button :class="[editor.isActive('heading', { level: 2 }) ? 'bg-orange-500 text-white' : 'hover:bg-gray-200']"
                class="px-3 py-2"
                title="Heading 1"
                type="button"
                @click="() => editor.chain().focus().toggleHeading({ level: 2 }).run()">
          <i class="ri-h-1"></i>
        </button>
      </li>
      <li>
        <button :class="[editor.isActive('heading', { level: 3 }) ? 'bg-orange-500 text-white' : 'hover:bg-gray-200']"
                class="px-3 py-2"
                title="Heading 2"
                type="button"
                @click="() => editor.chain().focus().toggleHeading({ level: 3 }).run()">
          <i class="ri-h-2"></i>
        </button>
      </li>
      <li>
        <button :class="[editor.isActive('heading', { level: 4 }) ? 'bg-orange-500 text-white' : 'hover:bg-gray-200']"
                class="px-3 py-2"
                title="Heading 3"
                type="button"
                @click="() => editor.chain().focus().toggleHeading({ level: 4 }).run()">
          <i class="ri-h-3"></i>
        </button>
      </li>
    </menu>
    <EditorContent :editor="editor" />
  </div>
</template>

<script setup>
import "remixicon/fonts/remixicon.css";

import { EditorContent, useEditor } from "@tiptap/vue-3";
import { StarterKit } from "@tiptap/starter-kit";
import { Link } from "@tiptap/extension-link";
import { watch } from "vue";
import { Markdown } from "tiptap-markdown";

const props = defineProps({
  modelValue: ""
});

const emit = defineEmits(["update:modelValue"]);

const editor = useEditor({
  extensions: [
    StarterKit.configure({
      heading: {
        levels: [2, 3, 4]
      },
      code: false,
      codeBlock: false
    }),
    Link,
    Markdown
  ],
  editorProps: {
    attributes: {
      class: "min-h-[512px] prose prose-sm max-w-none py-1.5 px-3"
    }
  },
  onUpdate: () => emit("update:modelValue", editor.value?.storage.markdown.getMarkdown())
});

watch(() => props.modelValue, (value) => {
  if (value === editor.value?.storage.markdown.getMarkdown()) {
    return;
  }

  editor.value?.commands.setContent(value);
}, { immediate: true });

const promptUserForHref = () => {
  if (editor.value?.isActive("link")) {
    return editor.value?.chain().unsetLink().run();
  }

  const href = prompt("Where do you want to link to?");

  if (!href) {
    return editor.value?.chain().focus().run();
  }

  return editor.value?.chain().focus().setLink({ href }).run();
};

</script>