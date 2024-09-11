<template>
    <Authenticated :is-fetching="isFetching">
        <template #header>
            <div
                class="flex justify-between items-center min-w-full px-2 text-lg font-extrabold text-sky-700 dark:text-sky-500 uppercase">
                <h3>Modules</h3>
                <Button @click="openNewForm" style="font-size: .8rem; padding: 3px 8px; " severity="secondary"
                    label="Add Module" text raised />
            </div>
        </template>

        <template #items-list>
            <template v-for="(module, i) in moduleStore.modules" :key="module.id">
                <ModuleItem :module="module" :i="i" @make-changes="openUpdateForm" />
            </template>
        </template>

        <template #form>
            <ModuleForm :data="formData" :mode="formMode" :visible="formVisibility" @close-me="closeForm" />
        </template>

    </Authenticated>
</template>

<script setup lang="ts">
    import { useModulesStore } from '@/stores/modules';
    import { useCoursesStore } from '@/stores/courses';
    import { onMounted, ref } from 'vue';
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

    onMounted(async () => {
        isFetching.value = true
        await moduleStore.fetchModules();
        isFetching.value = false
    })
</script>