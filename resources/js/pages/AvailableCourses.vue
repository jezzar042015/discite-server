<template>
    <div class="p-4">
        <div class="flex justify-between items-center">
            <div class="font-bold text-2xl">
                Available Courses
            </div>

            <div class="flex flex-col gap-4">
                <router-link :to="{ name: 'Dashboard' }">Back to Dashboard</router-link>
            </div>
        </div>

        <div class="flex flex-col p-4 gap-2">
            <div v-for="course in courses" :key="course.id" class="p-2 border border-slate-800 rounded-sm">
                <div class="font-semibold">
                    {{ course.title }}
                </div>
                <div class="text-sm">
                    {{ course.description }}
                </div>
                <div class="text-xs">
                    <router-link :to="`/courses/${course.id}/modules`">
                        See Course {{ course.modules_count }} Modules
                    </router-link>
                </div>
            </div>
        </div>

    </div>
</template>

<script setup lang="ts">
    import { useCoursesStore } from '@/stores/courses';
    import { APICourseArrayItem } from '@/types/course';
    import { onMounted } from 'vue';

    const courseStore = useCoursesStore()
    const courses = courseStore.courses as APICourseArrayItem[]

    onMounted(async () => {
        await courseStore.fetchCourses()
    })
</script>

<style scoped></style>