<template>
    <div>
        <div class="py-2 px-4 text-sm uppercase text-gray-500 dark:text-gray-400 cursor-default">
            Courses
        </div>
        <ul class="flex flex-col gap-2">
            <li v-for="course in courseStore.courses" :key="course.id" @click="routeTo(course.id)"
                class="py-2 px-4 hover:bg-sky-200 dark:hover:bg-slate-800 ease-out duration-200">
                {{ course.title }}
            </li>
        </ul>
    </div>
</template>

<script setup lang="ts">
    import { useCoursesStore } from '@/stores/courses';
    import { useRouter } from 'vue-router';
    const courseStore = useCoursesStore()
    const router = useRouter()

    const routeTo = (courseId: string) => {
        router.push(`/courses/${courseId}/modules`);
    }
</script>
