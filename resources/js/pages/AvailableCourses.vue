<template>
    <Authenticated :is-fetching="isFetching">
        
        <template #header>
            <div
                class="flex justify-between items-center min-w-full px-2 text-lg font-extrabold text-sky-700 uppercase dark:text-sky-500">
                <h3>COURSES</h3>
                <Button @click="openNewForm" style="font-size: .8rem; padding: 3px 8px; " severity="secondary"
                    label="Add Course" text raised />
            </div>
        </template>

        <template #items-list>
            <template v-for="course in courseStore.courses" :key="course.id">
                <CourseItem :course="course" @make-changes="makeChanges" />
            </template>
        </template>

        <template #form>
            <CoureForm :data="formData" :visible="form" :mode="formMode" @close-me="closeForm" />
        </template>
    </Authenticated>
</template>

<script setup lang="ts">
    import { useCoursesStore } from '@/stores/courses';
    import { onMounted, ref } from 'vue';
    import { APICourseArrayItem, APICourseRequest } from '@/types/course';
    import Button from 'primevue/button';
    import CoureForm from '@/components/CourseForm.vue'
    import CourseItem from '@/components/CourseItem.vue'
    import Authenticated from '@/layouts/Authenticated.vue'

    const isFetching = ref(false);
    const courseStore = useCoursesStore();
    const form = ref(false)
    const formMode = ref<'new' | 'update'>('new')
    const formData = ref<APICourseRequest>({
        title: '',
        description: '',
        level: 'BEGINNER',
        publish: false,
        is_premium: false,
    });

    const makeChanges = (course: APICourseArrayItem) => {
        formMode.value = 'update';
        formData.value.title = course.title;
        formData.value.description = course.description;
        formData.value.level = course.level;
        formData.value.is_premium = course.is_premium;
        formData.value.publish = course.publish;
        form.value = true;
    }

    const openNewForm = () => {
        formMode.value = 'new';
        formData.value.title = "";
        formData.value.description = "";
        formData.value.level = "BEGINNER";
        formData.value.is_premium = false;
        formData.value.publish = false;
        form.value = true;
    }

    const closeForm = () => {
        form.value = false;
    }

    onMounted(async () => {
        isFetching.value = true
        await courseStore.fetchCourses();
        isFetching.value = false
    });

</script>