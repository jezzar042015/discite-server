<template>
    
    <template v-if="block.data.level == 1">
        <h1 class="editor-js" v-html="block.data.text"></h1>
    </template>

    <template v-else-if="block.data.level == 2">
        <h2 class="editor-js" v-html="block.data.text"></h2>
    </template>

    <template v-else-if="block.data.level == 3">
        <h3 class="editor-js" v-html="block.data.text"></h3>
    </template>

    <template v-else-if="block.data.level == 4">
        <h4 class="editor-js" v-html="block.data.text"></h4>
    </template>

    <template v-else-if="block.data.level == 5">
        <h5 class="editor-js" v-html="block.data.text"></h5>
    </template>

    <template v-else-if="block.data.level == 6">
        <h6 class="editor-js" v-html="block.data.text"></h6>
    </template>
</template>

<script setup lang="ts">
    import { OutputBlockData } from '@editorjs/editorjs';

    const { block } = defineProps<{
        block: OutputBlockData
    }>();
    
</script>

<style scoped>
    h1 {
        font-weight: 600;
        font-size: 1.5em;
    }

    h2 {
        font-weight: 600;
        font-size: 1.4em;
    }

    h3 {
        font-weight: 600;
        font-size: 1.3em;
    }

    h4 {
        font-weight: 600;
        font-size: 1.2em;
    }

    h5 {
        font-weight: 600;
        font-size: 1.1em;
    }

    h6 {
        font-weight: 600;
        font-size: 1.05em;
    }
</style>
