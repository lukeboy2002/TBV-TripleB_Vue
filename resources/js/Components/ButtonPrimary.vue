<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center rounded-md border border-transparent bg-orange-500 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-orange-700 focus:bg-orange-700 focus:outline-none active:bg-orange-700 disabled:opacity-50"
    >
        <slot />
    </button>
</template>
