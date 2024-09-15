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
                <InputText type="text" v-model="data.title" variant="filled" />
            </div>

            <div class="flex flex-col w-full gap-2">
                <label class="uppercase text-xs" for="overview">Lesson Overview</label>
                <Textarea id="overview" v-model="data.overview" fluid autoResize variant="filled"
                    placeholder="This will be the sneak peak of students before browsing this lesson" />
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

            <div class="flex w-full gap-2 text-gray-800 dark:text-gray-400">
                <strong>Note:</strong> Lesson content would be written on our Content Editor. 
                <!-- <label class="uppercase text-xs" for="description">Content</label> -->
                <!-- <ContentEditor :changeNotificationQuillEditor="changed" v-model="data.content" /> -->
            </div>

        </template>

        <template #foot>
            <div class="h-12 flex gap-3 p-1">
                <Button @click="save" label="Save" text raised severity="info" />
                <Button @click="closeMe" severity="secondary" label="Discard" text raised />
            </div>
        </template>
        </ ModalContainer>
</template>

<script setup lang="ts">
    import ModalContainer from '@/layouts/ModalContainer.vue';
    import { APILessonRequest } from '@/types/lesson';
    import { computed } from 'vue';
    import ToggleSwitch from 'primevue/toggleswitch';
    import InputText from 'primevue/inputtext';
    import Button from 'primevue/button';
    import Textarea from 'primevue/textarea';
    import { useLessonsStore } from '@/stores/lessons';

    const emits = defineEmits(['close-me']);
    const lessonStore = useLessonsStore()
    const { visible, mode, data } = defineProps<{
        visible: boolean,
        mode: 'new' | 'update',
        data: APILessonRequest
    }>();

    const formTitle = computed(() => {
        return `${mode == 'new' ? 'New' : 'Update'} Lesson`;
    })

    async function save() {
        if (mode === 'update') {
            await lessonStore.update(data);
        } else {
            await lessonStore.insert(data);
            if (lessonStore.module_id)
                await lessonStore.fetchByModule(lessonStore.module_id)
        }
        emits('close-me');
    }

    function closeMe() {
        emits('close-me')
    }
</script>
