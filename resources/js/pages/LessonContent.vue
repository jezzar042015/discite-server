<template>
    <Authenticated :is-fetching="isFetching">

        <template #items-list>
            <div class="flex flex-col gap-4 min-h-screen p-8 md:p-10 rounded-md bg-white dark:bg-gray-800 -mt-2">
                <div class="">
                    <span class="text-xs text-gray-500 dark:text-gray-200">LESSON</span>
                    <p class="font-bold text-xl text-sky-400">
                        {{ lessonStore.selected?.title }}
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

                    <div class="flex flex-col gap-3 my-2">
                        <div v-for="par in paragraphs" :key="par" class="font-normal rounded-smx">
                            <div class="content" v-html="par"></div>
                            <!-- <div class="content">{{ par }}</div> -->

                        </div>
                    </div>
                </div>

                <div>
                    <Button @click="openForm" label="Make Changes" severity="info" text raised />
                </div>

            </div>

        </template>

        <template #form>
            <LessonForm :visible="formVisibility" :mode="'update'" :data="formData" @close-me="closeForm" />
        </template>

    </Authenticated>
</template>

<script setup lang="ts">
    import { useLessonsStore } from '@/stores/lessons';
    import { computed, onMounted, ref } from 'vue';
    import Authenticated from '@/layouts/Authenticated.vue'
    import LessonForm from '@/components/LessonForm.vue';
    import { APILessonRequest } from '@/types/lesson';
    import Button from 'primevue/button';

    const isFetching = ref(false)
    const lessonStore = useLessonsStore()
    const published = computed(() => {
        if (!lessonStore.selected) return null
        return lessonStore.selected.publish ? 'Published' : 'Unpublished'
    });

    const formVisibility = ref(false);
    const formData = ref<APILessonRequest>({
        title: lessonStore.selected?.title ?? '',
        content: lessonStore.selected?.content ?? '',
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
        formData.value.content = lessonStore.selected?.content ?? ''
        formData.value.module_id = lessonStore.selected?.module_id ?? ''
        formData.value.author_id = lessonStore.selected?.author_id ?? null
        formData.value.is_premium = lessonStore.selected?.is_premium ?? false
        formData.value.publish = lessonStore.selected?.publish ?? false
        formData.value.order = lessonStore.selected?.order ?? 0
        formVisibility.value = true
    }

    const contentAccess = computed(() => {
        if (!lessonStore.selected) return null
        return lessonStore.selected.is_premium ? 'Premium' : 'Free'
    })

    const paragraphs = computed(() => {
        if (!lessonStore.selected) return [];
        return lessonStore.selected.content.split('\n\n');
    });

    const backUrl = computed(() => {
        if (lessonStore.module_id) {
            return `/modules/${lessonStore.module_id}/lessons`;
        }
        return `/dashboard`;
    });

    onMounted(async () => {
        isFetching.value = true
        await lessonStore.fetchById()
        isFetching.value = false
    });
</script>

<style scoped>
    :deep(.content h1)
    {
        font-size: 1.3em;
        font-weight: 600;
        color: rgb(56, 189, 248);
    }

    :deep(.content h2)
    {
        font-size: 1.1em;
        font-weight: 600;
        color: rgb(56, 189, 248);
    }

    :deep(.content li[data-list="bullet"])
    {
        list-style-type: disc;
        padding: .4em .8em;
        margin-left: .8em;
    }

    :deep(.content li[data-list="ordered"])
    {
        list-style-type: decimal;
        padding: .4em .8em;
        margin-left: .8em;
    }

    :deep(.ql-code-block)
    {
        padding: 2em 2em;
        background: rgba(7, 70, 122, 0.918);
        color: white;
        border-radius: .3em .3em 0em 0em;
    }

    :deep(.ql-align-center)
    {
        text-align: center;
    }
</style>