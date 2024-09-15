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

            <div v-if="noCourses"
                class="flex flex-col gap-4 bg-white/50 dark:bg-gray-900/50 p-10 rounded-lg w-full text-center shadow">
                <i class="pi pi-exclamation-circle text-sky-700/50 dark:text-sky-700" style="font-size: 4em;"></i>
                <p>
                    No courses created yet! Start by adding a new one.
                </p>
            </div>
        </template>

        <template #form>
            <CoureForm :data="formData" :visible="form" :mode="formMode" @close-me="closeForm" />
        </template>
    </Authenticated>
</template>

<script setup lang="ts">
    import { useCoursesStore } from '@/stores/courses';
    import { computed, onMounted, ref } from 'vue';
    import { APICourseArrayItem, APICourseRequest } from '@/types/course';
    import Button from 'primevue/button';
    import CoureForm from '@/components/CourseForm.vue'
    import CourseItem from '@/components/CourseItem.vue'
    import Authenticated from '@/layouts/Authenticated.vue'
    import { useUserStore } from '@/stores/user';

    const courseStore = useCoursesStore();
    const userStore = useUserStore()
    const isFetching = ref(false);
    const form = ref(false)
    const formMode = ref<'new' | 'update'>('new')
    const formData = ref<APICourseRequest>({
        title: '',
        description: '',
        level: 'BEGINNER',
        publish: false,
        is_premium: false,
        author_id: null
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
        formData.value.author_id = userStore.current?.id || null;
        form.value = true;
    }

    const closeForm = () => {
        form.value = false;
    }

    const noCourses = computed(() => {
        return courseStore.courses.length === 0
    })

    onMounted(async () => {
        isFetching.value = true
        await courseStore.fetchCourses();
        isFetching.value = false
    });

</script>