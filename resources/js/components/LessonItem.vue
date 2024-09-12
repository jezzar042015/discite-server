<template>
    <div
        class="flex flex-col gap-2 bg-white p-4 rounded-md shadow hover:shadow-md dark:bg-gray-900 dark:shadow-md dark:shadow-black/40">

        <div class="text-xs">
            Lesson {{ i + 1 }}
        </div>
        <router-link :to="`/lessons/${lesson.id}`">
            <div class="font-semibold text-sky-400">
                {{ lesson.title }}
            </div>
        </router-link>

        <div class="text-sm">
            <p>{{ contentPreview }}</p>
        </div>

        <router-link :to="`/lessons/${lesson.id}`">
            <div
                class="inline text-xs py-1 px-3 bg-sky-400/10 rounded-md hover:bg-sky-400/30 ease-out duration-300 dark:bg-sky-400/15 shadow">
                <button>View Full Content</button>
            </div>
        </router-link>
    </div>
</template>

<script setup lang="ts">
    import { APILessonArrayItem } from '@/types/lesson';
    import { computed } from 'vue';

    const { lesson, i } = defineProps<{
        lesson: APILessonArrayItem
        i: number
    }>();

    const contentPreview = computed(() => {
        const sanitized = lesson.content.replace(/<[^>]*>/g, ' ')
        return sanitized.substring(0, 230) + '  ....'
    })

</script>