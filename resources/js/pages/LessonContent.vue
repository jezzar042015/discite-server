<template>
    <Authenticated :is-fetching="isFetching">

        <template #items-list>
            <div v-if="!editorVisibility" class="flex flex-col w-full gap-4 min-h-screen p-8 md:p-10 rounded-md bg-white dark:bg-gray-800 -mt-2">
                <div class="">
                    <span class="text-xs text-gray-500 dark:text-gray-200">LESSON</span>
                    <p class="font-bold text-xl text-sky-400">
                        {{ lessonStore.selected?.title }}
                    </p>
                    <span class="text-xs text-gray-500 dark:text-gray-200">OVERVIEW: </span>
                    <p>
                        {{ lessonStore.selected?.overview }}
                    </p>
                </div>

                <div class="grid grid-cols-2">
                    <div class="">
                        <span class="text-xs text-gray-500 dark:text-gray-200">STATUS</span>
                        <p class="">
                            {{ published }}
                        </p>
                    </div>

                    <div class="">
                        <span class="text-xs text-gray-500 dark:text-gray-200">ACCESS</span>
                        <p class="">
                            {{ contentAccess }}
                        </p>
                    </div>
                </div>

                <div class="">
                    <span class="text-xs text-gray-500 dark:text-gray-200">CONTENT</span>
                    <hr class="py-3">

                    <ContentRender :blocks="lessonStore.selected?.content?.blocks || []"/>
                </div>

                <div class="flex gap-4">
                    <Button @click="openForm" label="Make Changes" severity="info" text raised size="small" />
                    <Button @click="openContentEditor" label="Update Content" severity="info" text raised
                        size="small" />
                </div>

            </div>

        </template>

        <template #form>
            <ContentEditor :title="formData.title" :content="formData.content" :id="lessonStore.selected?.id ?? ''"
                v-if="editorVisibility" @save-content="saveContent" @close-editor="closeContentEditor" />
            <LessonForm :visible="formVisibility" :mode="'update'" :data="formData" @close-me="closeForm" />
        </template>

    </Authenticated>
</template>

<script setup lang="ts">
    import { useLessonsStore } from '@/stores/lessons';
    import { computed, onMounted, ref } from 'vue';
    import { APILessonRequest } from '@/types/lesson';
    import Authenticated from '@/layouts/Authenticated.vue'
    import LessonForm from '@/components/LessonForm.vue';
    import Button from 'primevue/button';
    import ContentEditor from '@/components/ContentEditor.vue';
    import ContentRender from '@/components/content/ContentRender.vue'

    const isFetching = ref(false)
    const lessonStore = useLessonsStore()
    const published = computed(() => {
        if (!lessonStore.selected) return null
        return lessonStore.selected.publish ? 'Published' : 'Unpublished'
    });

    const formVisibility = ref(false);
    const editorVisibility = ref(false);

    const formData = ref<APILessonRequest>({
        title: lessonStore.selected?.title ?? '',
        content: lessonStore.selected?.content ?? null,
        overview: lessonStore.selected?.overview ?? '',
        module_id: lessonStore.selected?.module_id ?? '',
        author_id: lessonStore.selected?.author_id ?? null,
        is_premium: lessonStore.selected?.is_premium ?? false,
        publish: lessonStore.selected?.publish ?? false,
        order: lessonStore.selected?.order ?? 0,
    })

    const closeForm = async () => {
        formVisibility.value = false
    }

    const openForm = async () => {
        formData.value.title = lessonStore.selected?.title ?? ''
        formData.value.overview = lessonStore.selected?.overview ?? ''
        formData.value.module_id = lessonStore.selected?.module_id ?? ''
        formData.value.author_id = lessonStore.selected?.author_id ?? null
        formData.value.is_premium = lessonStore.selected?.is_premium ?? false
        formData.value.publish = lessonStore.selected?.publish ?? false
        formData.value.order = lessonStore.selected?.order ?? 0
        formVisibility.value = true
    }

    const openContentEditor = async () => {
        editorVisibility.value = true
        formData.value.content = lessonStore.selected?.content ?? {
            blocks: [],
            time: 0,
            version: '',
        }
    }

    const contentAccess = computed(() => {
        if (!lessonStore.selected) return null
        return lessonStore.selected.is_premium ? 'Premium' : 'Free'
    })

    async function saveContent(id: string, editorContent: any) {
        await lessonStore.saveContent(id, editorContent)
    }

    function closeContentEditor () {
        editorVisibility.value = false
    }

    onMounted(async () => {
        isFetching.value = true
        await lessonStore.fetchById()
        isFetching.value = false
    });
</script>

<style scoped>
   
</style>