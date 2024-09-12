<template>
    <Authenticated :is-fetching="isFetching">

        <template #header>
            <div
                class="flex justify-between items-center min-w-full px-2 text-lg font-extrabold text-sky-700 dark:text-sky-500 uppercase">
                <h3>Lessons</h3>
                <Button @click="openNewForm" style="font-size: .8rem; padding: 3px 8px; " severity="secondary"
                    label="Add Lesson" text raised />
            </div>
        </template>

        <template #items-list>
            <template v-for="(lesson, i) in lessonStore.lessons" :key="lesson.id">
                <LessonItem :lesson="lesson" :i="i" />
            </template>
        </template>

        <template #form>
            <LessonForm :visible="formVisibility" :mode="'new'" :data="formData" @close-me="closeForm" />
        </template>
    </Authenticated>
</template>

<script setup lang="ts">
    import { useLessonsStore } from '@/stores/lessons';
    import { onMounted, ref } from 'vue';
    import { useRoute } from 'vue-router';
    import Authenticated from '@/layouts/Authenticated.vue'
    import LessonItem from '@/components/LessonItem.vue'
    import Button from 'primevue/button';
    import LessonForm from '@/components/LessonForm.vue';
    import { APILessonRequest } from '@/types/lesson';
    import { useModulesStore } from '@/stores/modules';
    import { useUserStore } from '@/stores/user';

    const isFetching = ref(false)
    const lessonStore = useLessonsStore();
    const moduleStore = useModulesStore();
    const userStore = useUserStore()
    const route = useRoute();


    const formVisibility = ref(false)
    const formData = ref<APILessonRequest>({
        title: '',
        content: '',
        order: 0,
        publish: false,
        is_premium: false,
        module_id: '',
        author_id: '',
    });

    const openNewForm = async () => {
        formData.value.module_id = moduleStore.selected ? moduleStore.selected.id : route.params.id.toString()
        formData.value.title = ''
        formData.value.content = ''
        formData.value.order = 0
        formData.value.publish = false
        formData.value.is_premium = false
        formData.value.author_id = ''
        formVisibility.value = true
    };

    const closeForm = async () => {
        formVisibility.value = false
    }
    
    onMounted(async () => {
        isFetching.value = true
        const moduleId = route.params.id.toString()
        await lessonStore.fetchByModule(moduleId)
        isFetching.value = false
    })
</script>
