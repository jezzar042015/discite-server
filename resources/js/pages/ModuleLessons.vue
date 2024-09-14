<template>
    <Authenticated :is-fetching="isFetching">

        <template #parent-info>
            <div class="flex flex-col gap-1 bg-white dark:bg-gray-900 px-4 py-3 rounded-lg w-full shadow">
                <label class="uppercase text-xs" for="">COURSE</label>
                <span class="font-bold text-sky-600 dark:text-sky-400 text-base"> {{ courseStore.selected?.title
                    }}</span>
                <label class="uppercase text-xs" for="">MODULE</label>
                <span class="font-bold text-sky-600 dark:text-sky-400 text-2xl"> {{ moduleStore.selected?.title
                    }}</span>
                <span class="text-sm text-gray-600 dark:text-gray-200"> {{ moduleStore.selected?.description }}</span>
                <div class="w-fit flex gap-2 flex-wrap py-2">

                    <div
                        class="flex gap-2 items-center text-xs py-1 px-3 bg-sky-400/40 rounded-xl uppercase dark:bg-sky-400/15">
                        <i v-if="moduleStore.selected?.is_premium" class="pi pi-credit-card"
                            style="font-size: .8rem;"></i>
                        <i v-else class="pi pi-unlock" style="font-size: .8rem;"></i>
                        {{ moduleStore.selected?.is_premium ? 'premium' : 'free' }} access
                    </div>

                    <div
                        class="flex gap-2 items-center text-xs py-1 px-3 bg-sky-400/40 rounded-xl uppercase dark:bg-sky-400/15">
                        <i v-if="moduleStore.selected?.publish" class="pi pi-cloud" style="font-size: .8rem;"></i>
                        <i v-else class="pi pi-file" style="font-size: .8rem;"></i>
                        {{ moduleStore.selected?.publish ? 'published' : 'unpublished' }}
                    </div>
                </div>

            </div>
        </template>

        <template #header>
            <div
                class="flex justify-between items-center min-w-full px-2 text-lg font-extrabold text-sky-700 dark:text-sky-500 uppercase">
                <h3>Lessons</h3>
                <Button @click="openNewForm" style="font-size: .8rem; padding: 3px 8px; " severity="secondary"
                    label="Add Lesson" text raised />
            </div>
        </template>

        <template #items-list>
            <template v-for="(lesson, i) in lessonStore.lessons" :key="lesson.id">
                <LessonItem :lesson="lesson" :i="i" />
            </template>

            <div v-if="lessonStore.lessons.length === 0"
                class="flex flex-col gap-4 bg-white/50 dark:bg-gray-900/50 p-10 rounded-lg w-full text-center shadow">
                <i class="pi pi-exclamation-circle text-sky-700/50 dark:text-sky-700" style="font-size: 4em;"></i>
                <p>
                    No lessons are added yet for this module! Start by adding a new one.
                </p>
            </div>
        </template>

        <template #form>
            <LessonForm :visible="formVisibility" :mode="'new'" :data="formData" @close-me="closeForm" />
        </template>
    </Authenticated>
</template>

<script setup lang="ts">
    import { useLessonsStore } from '@/stores/lessons';
    import { onMounted, ref } from 'vue';
    import { useRoute } from 'vue-router';
    import Authenticated from '@/layouts/Authenticated.vue'
    import LessonItem from '@/components/LessonItem.vue'
    import Button from 'primevue/button';
    import LessonForm from '@/components/LessonForm.vue';
    import { APILessonRequest } from '@/types/lesson';
    import { useModulesStore } from '@/stores/modules';
    import { useCoursesStore } from '@/stores/courses';

    const isFetching = ref(false)
    const lessonStore = useLessonsStore();
    const moduleStore = useModulesStore();
    const courseStore = useCoursesStore()
    const route = useRoute();

    const formVisibility = ref(false)
    const formData = ref<APILessonRequest>({
        title: '',
        content: null,
        overview: '',
        order: 0,
        publish: false,
        is_premium: false,
        module_id: '',
        author_id: '',
    });

    const openNewForm = async () => {
        formData.value.module_id = moduleStore.selected ? moduleStore.selected.id : route.params.id.toString()
        formData.value.title = ''
        formData.value.content = {
            blocks: [],
            time: 0,
            version: '',
        }
        formData.value.overview = ''
        formData.value.order = 0
        formData.value.publish = false
        formData.value.is_premium = false
        formData.value.author_id = ''
        formVisibility.value = true
    };

    const closeForm = async () => {
        formVisibility.value = false
    }

    const fetchParentIfFailed = async (id: string) => {
        if (moduleStore.selected) return
        await moduleStore.getModule(id)
    }

    onMounted(async () => {
        isFetching.value = true
        const moduleId = route.params.id.toString()
        await fetchParentIfFailed(moduleId)
        await lessonStore.fetchByModule(moduleId)
        isFetching.value = false
    })
</script>
