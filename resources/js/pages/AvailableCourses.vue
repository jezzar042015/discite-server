<template>
    <div>
        Available Courses

        <div class="flex flex-col gap-4">
            <router-link :to="{ name: 'Dashboard' }">Back to Dashboard</router-link>
        </div>

        <div class="flex flex-col p-4 gap-2">
            <div v-for="course in courses" :key="course.id">
                <div class="text-lg">
                    <router-link :to="`/courses/${course.id}/modules`">
                        {{ course.title }}
                    </router-link>
                </div>
                <div class="text-sm">{{ course.description }}</div>
                <div class="text-sm">Modules: {{ course.modules_count }}</div>
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