<template>
    <div class="p-4">

        Lesson's Content

        <div class="flex flex-col gap-4">
            <router-link :to="backUrl">Back to All Lessons</router-link>
        </div>

        <div class="py-4">
            <span class="text-xs text-gray-500">TITLE</span>
            <p class="font-bold text-2xl text-sky-400">
                {{ lessonStore.selected?.title }}
            </p>
        </div>

        <div class="py-4">
            <span class="text-xs text-gray-500">STATUS</span>
            <p class="">
                {{ published }}
            </p>
        </div>

        <div class="py-4">
            <span class="text-xs text-gray-500">CONTENT ACCESS</span>
            <p class="">
                {{ contentAccess }}
            </p>
        </div>

        <div class="">
            <span class="text-xs text-gray-500">CONTENT</span>
            <p v-for="par in paragraphs" :key="par" 
                class="p-2 font-normal bg-sky-200/10 rounded-sm">
                {{ par }}
            </p>
        </div>

        <!-- <pre>
            {{ lessonStore.selected }}  
        </pre> -->
    </div>
</template>

<script setup lang="ts">
    import { useLessonsStore } from '@/stores/lessons';
    import { computed, onMounted } from 'vue';
    import { useRoute } from 'vue-router';

    const lessonStore = useLessonsStore()

    const published = computed(()=> {
        if (!lessonStore.selected) return null
        return lessonStore.selected.publish ? 'Published' : 'Unpublished'
    });

    const contentAccess = computed(()=> {
        if (!lessonStore.selected) return null
        return lessonStore.selected.is_premium ? 'Premium' : 'Public'
    })

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