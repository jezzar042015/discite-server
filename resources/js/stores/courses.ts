import { APICourseArrayItem } from "@/types/course";
import { defineStore } from "pinia";
import { ref } from "vue";

export const useCoursesStore = defineStore('courses', () => {

    const courses = ref<APICourseArrayItem[]>([]);

    const fetchCourses = async () => {

        try {
            const resp = await fetch('/api/courses/');
            if (!resp.ok) {
                throw new Error(`Response status: ${resp.status}`);
            }
            courses.value = (await resp.json()).data;
        } catch (error: unknown) {
            if (error instanceof Error) {
                console.error(error.message);
            } else {
                console.error("An unknown error occured");
            }
        }
    }

    return {
        courses,
        fetchCourses
    };
});
