<template>
    <div class="p-2 md:p-4 bg-gray-100 overflow-y-hidden dark:bg-gray-800 flex flex-col items-center min-h-screen">

        <!-- fixed header -->
        <div class="fixed left-0 top-0 shadow-lg w-full bg-white dark:bg-gray-700">
            <div class="m-auto flex w-full md:max-w-6xl">
                <div class="py-3 px-5 flex justify-between items-center w-full md:min-w-full ">
                    <div class="flex items-center gap-4">
                        <div class="uppercase flex gap-2 items-center font-semibold">
                            <i class="pi pi-book" style="font-size: .8rem;"></i>
                            COURSE TITLE
                        </div>

                    </div>
                    <div class="flex flex-col gap-4">
                        <router-link :to="{ name: 'Courses' }">Back to Courses</router-link>
                    </div>
                </div>
            </div>
        </div>


        <div v-if="!loading"
            class="flex flex-col justify-center items-center md:py-6 md:px-16 md:max-w-6xl gap-4 mt-14 md:mt-8 ">
            <div class="flex justify-between items-center min-w-full px-2 text-lg font-extrabold text-sky-700 uppercase">
                <h3>Modules</h3>
                <Button @click="openNewForm" style="font-size: .8rem; padding: 3px 8px; " severity="secondary"
                            label="Add Module" text raised />
            </div>

            <template v-for="(module, i) in moduleStore.modules" :key="module.id">
                <ModuleItem :module="module" :i="i" @make-changes="openUpdateForm"/>
            </template>
        </div>
        <div v-else class="min-h-screen min-w-80 h-full p-20 grid place-items-center">
            <CircleLoader class="-mt-32" />
        </div>

        <ModuleForm :data="formData" :mode="formMode" :visible="formVisibility" @close-me="closeForm"/>
    </div>
</template>

<script setup lang="ts">
    import { useModulesStore } from '@/stores/modules';
    import { useCoursesStore } from '@/stores/courses';
    import { onMounted, ref } from 'vue';
    import { useRoute } from 'vue-router';
    import CircleLoader from '@/components/loaders/CircleWave.vue'
    import ModuleItem from '@/components/ModuleItem.vue'
    import ModuleForm from '@/components/ModuleForm.vue'
    import { APIModuleArrayItem, APIModuleRequest } from '@/types/module';
    import Button from 'primevue/button';

    const loading = ref(false);
    const moduleStore = useModulesStore();
    const courseStore = useCoursesStore();

    const formVisibility = ref(false)
    const formMode = ref<'new' | 'update'>('new')
    const formData = ref<APIModuleRequest>({
        title: '',
        description: '',
        order: 0,
        publish: false,
        is_premium: false,
        course_id: ''
    });

    const closeForm = async () => {
        formVisibility.value = false
    }

    const openNewForm = async () => {
        formVisibility.value = true
        formMode.value = 'new'
        formData.value.course_id = courseStore.selected?.id; 
        formData.value.title = '';
        formData.value.description = '';
        formData.value.is_premium = false;
        formData.value.publish = false;
        formData.value.order = 0;
    }

    const openUpdateForm = async (module: APIModuleArrayItem) => {

        // transtorm data for form update
        formData.value.title = module.title
        formData.value.description = module.description
        formData.value.course_id = module.course_id
        formData.value.is_premium = module.is_premium
        formData.value.order = module.order
        formData.value.publish = module.publish

        formMode.value = 'update'
        formVisibility.value = true
    }

    onMounted(async () => {
        loading.value = true
        const route = useRoute()
        const courseId = route.params.id.toString()
        await moduleStore.fetchModules(courseId)
        loading.value = false
    })
</script>