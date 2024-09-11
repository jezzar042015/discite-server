<template>
    <Authenticated>

        <template #header>
            <div class="flex flex-col gap-4 h-screen p-4">
                <div class="">
                    <span class="text-xs text-gray-500">TITLE</span>
                    <p class="font-bold text-xl text-sky-400">
                        {{ lessonStore.selected?.title }}
                    </p>
                </div>

                <div class="grid grid-cols-2">
                    <div class="">
                        <span class="text-xs text-gray-500">STATUS</span>
                        <p class="">
                            {{ published }}
                        </p>
                    </div>

                    <div class="">
                        <span class="text-xs text-gray-500">ACCESS</span>
                        <p class="">
                            {{ contentAccess }}
                        </p>
                    </div>
                </div>

                <div class="">
                    <span class="text-xs text-gray-500">CONTENT</span>

                    <div class="flex flex-col gap-3">
                        <p v-for="par in paragraphs" :key="par" class="font-normal rounded-smx">
                            {{ par }}
                        </p>
                    </div>
                </div>
            </div>

        </template>

        <template #form>
            <LessonForm />
        </template>

    </Authenticated>
</template>

<script setup lang="ts">
    import { useLessonsStore } from '@/stores/lessons';
    import { computed, onMounted, ref } from 'vue';
    import { useRoute } from 'vue-router';
    import Authenticated from '@/layouts/Authenticated.vue'
    import LessonForm from '@/components/LessonForm.vue';

    const lessonStore = useLessonsStore()
    const published = computed(() => {
        if (!lessonStore.selected) return null
        return lessonStore.selected.publish ? 'Published' : 'Unpublished'
    });

    const contentAccess = computed(() => {
        if (!lessonStore.selected) return null
        return lessonStore.selected.is_premium ? 'Premium' : 'Free'
    })

    const paragraphs = computed(() => {
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