<template>
    <div class="p-4 bg-gray-100 overflow-y-hidden">
        <div class="fixed left-0 top-0 shadow-lg w-full bg-white">
            <div class="py-3 px-8 flex justify-between items-center">
                <div>
                    <div class="uppercase flex gap-2 items-center font-semibold">
                        <i class="pi pi-book" style="font-size: .8rem;"></i>
                        COURSE TITLE
                    </div>
                    <div class="text-sm font-extrabold text-sky-700 uppercase">
                        Modules
                    </div>
                </div>
                <div class="flex flex-col gap-4">
                    <router-link :to="{ name: 'Courses' }">Back to Courses</router-link>
                </div>
            </div>
        </div>

        <div class="flex flex-col p-6 gap-4 mt-10" v-if="!loading">
            <template v-for="(module, i) in moduleStore.modules" :key="module.id">
                <ModuleItem :module="module" :i="i" />
            </template>
        </div>
        <div v-else class="h-full p-20">
            <CircleLoader />
        </div>
    </div>
</template>

<script setup lang="ts">
    import { useModulesStore } from '@/stores/modules';
    import { onMounted, ref } from 'vue';
    import { useRoute } from 'vue-router';
    import CircleLoader from '@/components/loaders/CircleWave.vue'
    import ModuleItem from '@/components/ModuleItem.vue'

    const loading = ref(false)
    const moduleStore = useModulesStore()

    onMounted(async () => {
        loading.value = true
        const route = useRoute()
        const courseId = route.params.id.toString()
        await moduleStore.fetchModules(courseId)
        loading.value = false
    })
</script>