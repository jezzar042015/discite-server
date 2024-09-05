<template>
    <div>
        Course Modules

        <div class="flex flex-col gap-4 mt-3">
            <router-link :to="{ name: 'Courses' }">Back to Courses</router-link>
        </div>

        <div class="flex flex-col gap-4 mt-3">

            <div class="flex flex-col p-4 gap-2">
                <div v-for="module in modules" :key="module.id">
                    <div>
                        <router-link :to="`/modules/${module.id}/lessons`">
                            {{ module.title }}
                        </router-link>
                    </div>
                    <div>{{ module.description }}</div>
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