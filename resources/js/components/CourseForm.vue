<template>
    <ModalContainer>
        <div v-if="visible" class="bg-black/80 fixed h-screen w-screen grid place-items-center px-2 z-10 mt-0 dark:bg-black/75 dark:shadow-sm">
            <div class="flex flex-col bg-white shadow h-4/5 md:h-5/6 md:w-3/4 rounded-lg p-6 dark:bg-gray-800 -mt-20">
                <div class="h-6 font-extrabold text-md text-sky-400 uppercase">
                    {{ formTitle }}
                </div>

                <div class="flex-1 flex flex-col py-4 gap-10">
                    <div class="flex flex-col w-full gap-2">
                        <label class="uppercase text-xs" for="">Course Title</label>
                        <InputText type="text" v-model="data.title" />
                    </div>
                    <div class="flex flex-col w-full gap-2">
                        <label class="uppercase text-xs" for="">Difficulty Level</label>
                        <Select v-model="selectedLevel" :options="courseStore.levelOptions" optionLabel="name"
                            placeholder="Select.." class="w-full md:w-56" @change="updateLevel" />
                    </div>
                    <div class="flex flex-col w-full gap-2">
                        <label class="uppercase text-xs" for="description">Description</label>
                        <Textarea id="description" v-model="data.description" fluid autoResize />
                    </div>
                    <div class="flex gap-10">
                        <div class="flex items-center gap-4">
                            <ToggleSwitch inputId="published" v-model="data.publish" />
                            <label class="uppercase text-xs w-16 cursor-pointer" for="published">Published</label>
                        </div>
                        <div class="flex items-center gap-4">
                            <ToggleSwitch inputId="premium" v-model="data.is_premium" />
                            <label class="uppercase text-xs w-16 cursor-pointer" for="premium">Premium</label>
                        </div>
                    </div>
                </div>
                <div class="h-12 flex gap-3 p-1">
                    <Button @click="save" label="Save" text raised />
                    <Button @click="closeMe" severity="secondary" label="Discard" text raised />
                </div>
            </div>
        </div>
    </ModalContainer>
</template>

<script setup lang="ts">
    import { computed, ref, watch } from 'vue';
    import ToggleSwitch from 'primevue/toggleswitch';
    import InputText from 'primevue/inputtext';
    import Select from 'primevue/select';
    import Textarea from 'primevue/textarea';
    import Button from 'primevue/button';
    import { useCoursesStore } from '@/stores/courses';
    import { APICourseRequest, CourseLevel } from '@/types/course';
    import ModalContainer from '@/layouts/ModalContainer.vue'

    const courseStore = useCoursesStore()

    const selectedLevel = ref<{ code: CourseLevel | '' , name: string } | undefined>({
        code: '',
        name: '',
    });

    const emits = defineEmits(['close-me'])
    const props = defineProps<{
        visible: boolean,
        mode: 'new' | 'update',
        data: APICourseRequest
    }>();

    const formTitle = computed(() => {
        return `${props.mode == 'new' ? 'New' : 'Update'} Course`
    })

    async function save() {
        if (props.data.id) {
            await courseStore.update(props.data);
            emits('close-me');
        } else {
            await courseStore.insert(props.data);
            emits('close-me');
        }
    }

    function closeMe() {
        emits('close-me')
    }

    function updateLevel() {
        props.data.level = selectedLevel.value?.code ?? ''
    }

    watch(
        props.data,
        () => {
            if (!props.data.level) return
            const level = courseStore.levelOptions.find(crs => crs.code == props.data.level)
            if (level) selectedLevel.value = level
        },
        {
            immediate: true
        }
    );

</script>