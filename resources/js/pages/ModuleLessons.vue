<template>
    <div class="p-4">
        <div class="flex justify-between items-center">
            <div class="font-bold text-2xl">
                Module Lessons
            </div>

            <div class="flex flex-col gap-4">
                <router-link :to="`/courses/${moduleStore.course_id}/modules`">Back to Modules</router-link>
            </div>
        </div>

        <div class="flex flex-col p-4 gap-2">
            <div v-for="lesson in lessons" :key="lesson.id" class="p-2 border border-slate-800 rounded-sm">
                <div class="text-xs">
                    Lesson {{ lesson.order }}
                </div>

                <div class="font-semibold">
                    {{ lesson.title }}
                </div>

                <div class="text-xs">
                    <router-link :to="`/lessons/${lesson.id}`">
                        See Content
                    </router-link>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup lang="ts">
    import { useLessonsStore } from '@/stores/lessons';
    import { useModulesStore } from '@/stores/modules';
    import { onMounted } from 'vue';
    import { useRoute } from 'vue-router';

    const lessonStore = useLessonsStore()
    const moduleStore = useModulesStore()
    const lessons = lessonStore.lessons

    onMounted(() => {
        const route = useRoute()
        const moduleId = route.params.id.toString()
        lessonStore.fetchByModule(moduleId)
    })
</script>

<style scoped></style>