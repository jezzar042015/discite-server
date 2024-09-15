<template>
    <div>
        <div>
            <span class="text-sm font-semibold text-gray-600">LESSON 1</span>
            <h1>How Can the Bible Help You?</h1>
        </div>
        <div v-for="block in blocks" :key="block.id">

            <template v-if="block.type == 'header'">
                <RenderHeaders :block="block" />
            </template>

            <template v-else-if="block.type == 'paragraph'">
                <RenderParagraphs :block="block" />
            </template>

            <template v-else-if="block.type == 'list'">
                <template v-if="block.data.style == 'ordered'">
                    <ol>
                        <li class="list-decimal ms-6 pl-3" v-for="i in block.data.items" :key="i" v-html="i.content">
                        </li>
                    </ol>
                </template>
                <template v-else-if="block.data.style == 'unordered'">
                    <ul>
                        <li class="list-disc ms-6 pl-3" v-for="i in block.data.items" :key="i" v-html="i.content">
                        </li>
                    </ul>
                </template>

            </template>

            <pre v-else class="text-xs">{{ block }}</pre>
        </div>

    </div>
</template>

<script setup lang="ts">
    import { OutputBlockData } from '@editorjs/editorjs';
    import RenderHeaders from '@/components/content/RenderHeaders.vue'
    import RenderParagraphs from '@/components/content/RenderParagraphs.vue';

    const { blocks } = defineProps<{
        blocks: OutputBlockData[]
    }>()
</script>

<style scoped>

    h1,
    h2,
    h3,
    h4,
    h5,
    h6
    {
        margin-bottom: .5em;
        font-weight: 600;
        color: rgb(0, 172, 172);
        padding: .2em 0em;
    }

    h1
    {
        font-size: 1.8em;
        line-height: 1.1;
        font-weight: 700;
    }

    h2
    {
        font-size: 1.4em;
    }

    h3
    {
        font-size: 1.3em;
    }

    h4
    {
        font-size: 1.2em;
    }

    h5
    {
        font-size: 1.1em;
    }

    h6
    {
        font-size: 1.05em;
    }
</style>
