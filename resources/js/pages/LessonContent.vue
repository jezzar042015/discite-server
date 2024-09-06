<template>
    <div class="p-4">

        Lesson's Content

        <div class="flex flex-col gap-4">
            <router-link :to="backUrl">Back to All Lessons</router-link>
        </div>

        <div class="font-bold text-2xl">
            {{ lessonStore.selected?.title }}
        </div>

        <div class="font-normal">
            <p v-for="par in paragraphs" :key="par" class="py-2">
                {{ par }}
            </p>
        </div>

        <pre>
            {{ lessonStore.selected }}  
        </pre>
    </div>
</template>

<script setup lang="ts">
    import { useLessonsStore } from '@/stores/lessons';
    import { computed, onMounted } from 'vue';
    import { useRoute } from 'vue-router';

    const lessonStore = useLessonsStore()

    const paragraphs = computed(()=> {
        if (!lessonStore.selected) return [];
        return lessonStore.selected.content.split('\n\n');
    })

    const backUrl = computed(() => {
        if (lessonStore.module_id) {
            return `/modules/${lessonStore.module_id}/lessons`;
        }
        return `/dashboard`;
    })

    onMounted(() => {
        const route = useRoute()
        lessonStore.active_id = route.params.id.toString();
    });
</script>

<style scoped></style>