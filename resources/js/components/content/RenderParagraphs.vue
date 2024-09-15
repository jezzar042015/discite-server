<template>
    <p class="pt-1 pb-5 leading-relaxed" v-html="block.data.text"></p>

    <!-- <p class="text-xs bg-black text-white py-3 px-1 mt-3">
        {{ block.data.text }}
    </p> -->
</template>

<script setup lang="ts">
    import { OutputBlockData } from '@editorjs/editorjs';

    const { block } = defineProps<{
        block: OutputBlockData
    }>();
</script>

<style scoped>
    :deep(a)
    {
        /* background-color: rgba(0, 128, 128, 0.151); */
        padding: .1em .2em;
        border-radius: .2em;
        transition: ease-in-out .300s;
    }

    :deep(a:hover)
    {
        /* background-color: rgb(0, 128, 128); */
    }

    :deep(u)
    {
        color: rgb(0, 156, 156);
        text-underline-position: below;
        text-underline-offset: .3em;
        text-decoration-style: dotted;
    }

    :deep(b)
    {
        /* color: rgb(0, 156, 156); */
    }

    @media (prefers-color-scheme: dark)
    {
        :deep(a)
        {
            background-color: rgb(0, 128, 128);;
        }
    }
</style>
