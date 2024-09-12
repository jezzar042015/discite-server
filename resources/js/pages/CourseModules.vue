<template>
    <Authenticated :is-fetching="isFetching">

        <template #parent-info>
            <div class="flex flex-col gap-1 bg-white dark:bg-gray-900 px-4 py-3 rounded-lg w-full shadow">
                <label class="uppercase text-xs" for="">COURSE</label>
                <span class="font-bold text-sky-600 dark:text-sky-400 text-2xl"> {{ courseStore.selected?.title }}</span>
                <span class="text-sm text-gray-600 dark:text-gray-200"> {{ courseStore.selected?.description }}</span>
                <div class="w-fit flex gap-2 flex-wrap py-2">
                    <div class="flex gap-2 items-center text-xs py-1 px-3 bg-sky-400/40 rounded-xl dark:bg-sky-400/15">
                        <i class="pi pi-gauge" style="font-size: .8rem;"></i>
                        {{ courseStore.selected?.level }}
                    </div>

                    <div
                        class="flex gap-2 items-center text-xs py-1 px-3 bg-sky-400/40 rounded-xl uppercase dark:bg-sky-400/15">
                        <i v-if="courseStore.selected?.is_premium" class="pi pi-credit-card"
                            style="font-size: .8rem;"></i>
                        <i v-else class="pi pi-unlock" style="font-size: .8rem;"></i>
                        {{ courseStore.selected?.is_premium ? 'premium' : 'free' }} access
                    </div>

                    <div
                        class="flex gap-2 items-center text-xs py-1 px-3 bg-sky-400/40 rounded-xl uppercase dark:bg-sky-400/15">
                        <i v-if="courseStore.selected?.publish" class="pi pi-cloud" style="font-size: .8rem;"></i>
                        <i v-else class="pi pi-file" style="font-size: .8rem;"></i>
                        {{ courseStore.selected?.publish ? 'published' : 'unpublished' }}
                    </div>

                </div> 
                <div class="text-xs">
                    <span class="text-gray-600">Added: </span> <span>{{ courseStore.selected?.created_at }}</span>
                </div>
            </div>
        </template>

        <template #header>
            <div
                class="flex justify-between items-center min-w-full px-2 text font-extrabold text-sky-800 dark:text-sky-500 uppercase">
                <h2>Modules</h2>
                <Button @click="openNewForm" style="font-size: .8rem; padding: 3px 8px; " severity="secondary"
                    label="Add Module" raised/>
            </div>
        </template>

        <template #items-list>
            <div class="w-full h-auto grid grid-cols-1 md:grid-cols-2 grid-flow-row-dense gap-2">
                <template v-for="(module, i) in moduleStore.modules" :key="module.id">
                    <ModuleItem :module="module" :i="i" @make-changes="openUpdateForm" />
                </template>
            </div>

            <div v-if="noModules"
                class="flex flex-col gap-4 bg-white dark:bg-gray-900 p-10 rounded-lg w-full text-center shadow">
                <i class="pi pi-exclamation-circle text-sky-700/50 dark:text-sky-700" style="font-size: 4em;"></i>
                <p>
                    No modules are added yet for this course! Start by adding a new one.
                </p>
            </div>
        </template>

        <template #form>
            <ModuleForm :data="formData" :mode="formMode" :visible="formVisibility" @close-me="closeForm" />
        </template>

    </Authenticated>
</template>

<script setup lang="ts">
    import { useModulesStore } from '@/stores/modules';
    import { useCoursesStore } from '@/stores/courses';
    import { computed, onMounted, ref } from 'vue';
    import Button from 'primevue/button';
    import ModuleItem from '@/components/ModuleItem.vue'
    import ModuleForm from '@/components/ModuleForm.vue'
    import { APIModuleArrayItem, APIModuleRequest } from '@/types/module';
    import Authenticated from '@/layouts/Authenticated.vue'

    const isFetching = ref(false);
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
        formData.value.course_id = courseStore.selected?.id ?? '';
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

    const noModules = computed(() => {
        return moduleStore.modules.length === 0
    })

    onMounted(async () => {
        isFetching.value = true;
        await moduleStore.fetchModules();
        if (noModules.value) await openNewForm()
        isFetching.value = false;
    })
</script>