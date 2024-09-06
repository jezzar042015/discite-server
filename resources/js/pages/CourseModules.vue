<template>
    <div class="p-4">

        <div class="flex justify-between items-center">
            <div class="font-bold text-2xl">
                Course Modules
            </div>

            <div class="flex flex-col gap-4 mt-3">
                <router-link :to="{ name: 'Courses' }">Back to Courses</router-link>
            </div>
        </div>

        <div class="flex flex-col gap-4 mt-3">

            <div class="flex flex-col p-4 gap-2">
                <div v-for="module in modules" :key="module.id" class="p-2 border border-slate-800 rounded-sm">
                    <div class="text-xs">
                        MODULE {{ module.order }}
                    </div>

                    <div class="font-semibold">
                        {{ module.title }}
                    </div>

                    <div class="text-sm">
                        {{ module.description }}
                    </div>

                    <div class="text-xs">
                        <router-link :to="`/modules/${module.id}/lessons`">
                            See Lessons
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { useModulesStore } from '@/stores/modules';
    import { onMounted } from 'vue';
    import { useRoute } from 'vue-router';

    const moduleStore = useModulesStore()
    const modules = moduleStore.modules

    onMounted(async () => {
        const route = useRoute()
        const courseId = route.params.id.toString()
        await moduleStore.fetchModules(courseId)
    })
</script>

<style scoped></style>