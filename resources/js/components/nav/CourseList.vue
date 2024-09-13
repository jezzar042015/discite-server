<template>
    <div v-if="isVisible"
        class="absolute right-3 top-10 bg-gray-100/90 dark:bg-gray-700 w-fit h-fit px-0 py-2 shadow-xl z-10 rounded-sm whitespace-nowrap transition duration-300">
        <!-- <div class="py-2 px-4 text-sm uppercase text-gray-500 dark:text-gray-400 cursor-default">
            Courses
        </div> -->
        <ul class="flex flex-col gap-2">
            <li v-for="course in courseStore.courses" :key="course.id" @click="routeTo(course.id)"
                class="py-2 px-4 hover:bg-gray-200 dark:hover:bg-slate-800 ease-out duration-200 cursor-pointer">
                {{ course.title }}
            </li>
        </ul>
    </div>
</template>

<script setup lang="ts">
    import { useCoursesStore } from '@/stores/courses';
    import { useRouter } from 'vue-router';

    const { isVisible = false } = defineProps<
        {
            isVisible: boolean
        }>()

    const courseStore = useCoursesStore()
    const router = useRouter()

    const routeTo = (courseId: string) => {
        router.push(`/courses/${courseId}/modules`);
    }
</script>
