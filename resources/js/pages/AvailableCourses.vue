<template>
    <div class="p-2 md:p-4 bg-gray-100 overflow-y-hidden dark:bg-gray-800 flex flex-col items-center">

        <!-- fixed header -->
        <div class="fixed left-0 top-0 shadow-lg w-full bg-white dark:bg-gray-700">
            <div class="m-auto flex w-full md:max-w-6xl">
                <div class="py-3 px-5 flex justify-between items-center w-full md:min-w-full ">
                    <div class="flex items-center gap-4">
                        <div class="font-extrabold text-xl text-sky-700 uppercase dark:text-sky-400">
                            Courses
                        </div>
                        <Button @click="openNewForm" style="font-size: .8rem; padding: 3px 8px; " severity="secondary"
                            label="Create New" text raised />

                    </div>

                    <div class="flex flex-col gap-4">
                        <router-link :to="{ name: 'Dashboard' }">Dashboard</router-link>
                    </div>
                </div>
            </div>
        </div>

        <!-- course items list -->
        <div class="flex flex-col justify-center items-center md:py-6 md:px-16 md:max-w-6xl gap-4 mt-14 ">
            <template v-for="course in courseStore.courses" :key="course.id">
                <CourseItem :course="course" @make-changes="makeChanges" />
            </template>
        </div>

        <CoureForm :data="formData" :visible="form" :mode="formMode" @close-me="closeForm" />
    </div>
</template>

<script setup lang="ts">
    import { useCoursesStore } from '@/stores/courses';
    import { onMounted, ref } from 'vue';
    import { APICourseArrayItem, APICourseRequest } from '@/types/course';
    import Button from 'primevue/button';
    import CoureForm from '@/components/CourseForm.vue'
    import CourseItem from '@/components/CourseItem.vue'


    const courseStore = useCoursesStore()
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
        formData.value.id = course.id;
        formData.value.title = course.title;
        formData.value.description = course.description;
        formData.value.level = course.level;
        formData.value.is_premium = course.is_premium;
        formData.value.publish = course.publish;
        form.value = true;
    }

    const openNewForm = () => {
        formMode.value = 'new';
        formData.value.id = "";
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
        await courseStore.fetchCourses();
    });

</script>

<style scoped></style>