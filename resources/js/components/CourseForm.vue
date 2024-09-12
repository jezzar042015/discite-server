<template>
    <ModalContainer :isVisible="visible">

        <template #head>
            <div class="h-6 font-extrabold text-md text-sky-400 uppercase">
                {{ formTitle }}
            </div>
        </template>

        <template #main>
            
                <div class="flex flex-col w-full gap-2">
                    <label class="uppercase text-xs" for="">Title</label>
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
            <!-- </div> -->
        </template>

        <template #foot>
            <div class="h-12 flex gap-3 p-1">
                <Button @click="save" label="Save" text raised severity="info" />
                <Button @click="closeMe" severity="secondary" label="Discard" text raised />
            </div>
        </template>
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

    const selectedLevel = ref<{ code: CourseLevel, name: string }>({
        code: '',
        name: '',
    });

    const emits = defineEmits(['close-me'])
    const { visible, mode, data } = defineProps<{
        visible: boolean,
        mode: 'new' | 'update',
        data: APICourseRequest
    }>();

    const formTitle = computed(() => {
        return `${mode == 'new' ? 'New' : 'Update'} Course`
    })

    async function save() {
        if (mode === 'update') {
            await courseStore.update(data);
        } else {
            await courseStore.insert(data);
        }
        emits('close-me');
    }

    function closeMe() {
        emits('close-me')
    }

    function updateLevel() {
        data.level = selectedLevel.value?.code ?? ''
    }

    watch(
        () => data,
        () => {
            if (!data.level) return
            const level = courseStore.levelOptions.find(crs => crs.code == data.level)
            selectedLevel.value = level ? level : { code: '', name: '' }
        },
        {
            immediate: true
        }
    );

</script>