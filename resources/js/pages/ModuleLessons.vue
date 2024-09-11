<template>
    <Authenticated :is-fetching="isFetching">

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

    const isFetching = ref(false)
    const lessonStore = useLessonsStore();

    const openNewForm = async () => {

    };

    onMounted(async () => {
        isFetching.value = true
        const route = useRoute()
        const moduleId = route.params.id.toString()
        await lessonStore.fetchByModule(moduleId)
        isFetching.value = false
    })
</script>
