<template>
    <div class="z-20 w-full h-screen absolute top-0 bg-gray-200 dark:bg-gray-900 px-6 ">
        <div class="h-screen overflow-hidden flex flex-col gap-4 pb-5">

            <div class="flex justify-between items-center h-12 pt-8 pb-4">
                <div class="flex flex-col">
                    <span class="text-xs ">Your are writing for Lesson:</span>
                    <span class="font-semibold text-sky-700">{{ title }}</span>
                </div>

                <div class="flex gap-3">
                    <button @click="preview = !preview" class="py-1 px-3 bg-white/20 shadow rounded text-gray-700 dark:text-white text-sm">
                        {{ preview ? 'Edit' : 'Preview'}}
                    </button>
                    <button @click="save()" class="py-1 px-3 bg-white/20 shadow rounded text-gray-700 dark:text-white text-sm">
                        Save
                    </button>
                    <button @click="close()" class="py-1 px-3 bg-white/20 shadow rounded text-gray-700 dark:text-white text-sm">
                        Close
                    </button>
                </div>
            </div>

            <div class="flex-1 flex flex-col gap-4 overflow-hidden">
                <div v-show="!preview" class="shadow rounded-md bg-white dark:bg-gray-800 h-full p-2 overflow-y-auto" id="codex-editor" />
                <div v-show="preview" class="p-8 shadow-lg rounded-md bg-white dark:bg-gray-800 h-full p-2 overflow-y-auto">
                    <ContentRender :blocks="content?.blocks ?? null" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
    import EditorJS, { OutputData } from "@editorjs/editorjs";
    import { ref, onMounted } from "vue";
    import Header from "@editorjs/header";
    import Paragraph from "@editorjs/paragraph";
    import Quote from '@editorjs/quote';
    import Checklist from '@editorjs/checklist';
    import Table from '@editorjs/table';
    import Underline from '@editorjs/underline';
    import NestedList from '@editorjs/nested-list';
    import TextVariantTune from '@editorjs/text-variant-tune';
    import ContentRender from "./content/ContentRender.vue";


    const defBlock = { blocks: [], time: 0, version: '' }
    const { id, content = { blocks: [], time: 0, version: '' }, title } = defineProps<{
        id: string
        content: OutputData | null
        title: string
    }>();

    const editor = ref<EditorJS>()
    const preview = ref(false)
    const emits = defineEmits(['save-content', 'close-editor'])

    function myEditor() {
        editor.value = new EditorJS({
            data: content ?? defBlock,
            holder: "codex-editor",
            autofocus: true,
            tools: {
                header: {
                    class: Header,
                    shortcut: "CMD+SHIFT+H"
                },
                list: {
                    class: NestedList,
                    inlineToolbar: true,
                    config: {
                        defaultStyle: 'unordered'
                    },
                },
                paragraph: {
                    class: Paragraph,
                    config: {
                        placeholder: "."
                    }
                },
                quote: {
                    class: Quote,
                    inlineToolbar: true,
                    shortcut: 'CMD+SHIFT+O',
                    config: {
                        quotePlaceholder: 'Enter a quote',
                        captionPlaceholder: 'Quote\'s author',
                    },
                },
                checklist: {
                    class: Checklist,
                    inlineToolbar: true,
                },
                table: {
                    class: Table,
                    inlineToolbar: true,
                    config: {
                        rows: 2,
                        cols: 3,
                    },
                },
                underline: Underline,

            },
            // tunes: ['textVariant'],
            onReady: function () {
                console.log("ready");
            },
            onChange: function () {
                console.log("change");
            }
        });
    }

    async function save() {
        if (!editor.value) return
        const saved = await editor.value.save()
        emits('save-content', id, saved);
    }

    function close() {
        emits("close-editor");
    }

    onMounted(() => {
        myEditor();
    })
</script>