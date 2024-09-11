import { get, post, put } from "@/composables/server";
import { APICourseArrayItem, APICourseRequest } from "@/types/course";
import { defineStore } from "pinia";
import { ref } from "vue";

export const useCoursesStore = defineStore('courses', () => {

    const courses = ref<APICourseArrayItem[]>([]);
    const selected = ref<APICourseArrayItem | null>(null);

    const levelOptions = ref([
        { code: 'BEGINNER', name: 'Beginner' },
        { code: 'INTERMEDIATE', name: 'Intermediate' },
        { code: 'ADVANCED', name: 'Advanced' }
    ]);

    const fetchCourses = async () => {
        const resp = await get('/api/courses/');
        courses.value = (await resp?.json())?.data || [];
    }

    const update = async (form: APICourseRequest) => {
        await put(`/api/courses/${selected.value?.id}`, JSON.stringify(form));
        await fetchCourses();
    }

    const insert = async (form: APICourseRequest) => {
        await post(`/api/courses/`, JSON.stringify(form));
        await fetchCourses();
    }

    return {
        courses, levelOptions, selected,
        fetchCourses, update, insert
    };
});
