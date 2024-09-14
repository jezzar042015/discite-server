<template>
    <div>
        <div v-for="block in blocks" :key="block.id" >

            <template v-if="block.type == 'header'">
                <RenderHeaders :block="block"/>
            </template>

            <template v-else-if="block.type == 'paragraph'">
                <RenderParagraphs :block="block"/>
            </template>

            <template v-else-if="block.type == 'list'">
                <template v-if="block.data.style == 'ordered'">
                    <ol>
                        <li v-for="i in block.data.items" :key="i">
                            {{ i }}
                        </li>
                    </ol>
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
