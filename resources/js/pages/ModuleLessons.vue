<template>
    <div class="p-4 bg-gray-50">
        <div class="p-4 flex justify-between items-center">
            <div class="font-extrabold text-2xl text-sky-400">
                Module Lessons
            </div>

            <div class="flex flex-col gap-4">
                <router-link :to="`/courses/${moduleStore.course_id}/modules`">Back to Modules</router-link>
            </div>
        </div>

        <div class="flex flex-col p-6 gap-4" v-if="!loading">
            <div v-for="(lesson, i) in lessonStore.lessons" :key="lesson.id"
                class="bg-white p-4 rounded-md shadow hover:shadow-lg duration-300 ease-in-out hover:scale-105">
                <router-link :to="`/lessons/${lesson.id}`">
                    <div class="text-xs">
                        Lesson {{ i + 1 }}
                    </div>

                    <div class="font-semibold text-sky-400">
                        {{ lesson.title }}
                    </div>

                    <div class="text-xs">

                        See Content
                    </div>
                </router-link>
            </div>
        </div>
        <div v-else class="h-full p-20">
            <CircleLoader />
        </div>
    </div>
</template>

<script setup lang="ts">
    import { useLessonsStore } from '@/stores/lessons';
    import { useModulesStore } from '@/stores/modules';
    import { onMounted, ref } from 'vue';
    import { useRoute } from 'vue-router';
    import CircleLoader from '@/components/loaders/CircleWave.vue'

    const loading = ref(false)
    const lessonStore = useLessonsStore()
    const moduleStore = useModulesStore()

    onMounted(async () => {
        loading.value = true
        const route = useRoute()
        const moduleId = route.params.id.toString()
        await lessonStore.fetchByModule(moduleId)
        loading.value = false
    })
</script>
