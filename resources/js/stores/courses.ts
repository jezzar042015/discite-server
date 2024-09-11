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

    const update = async (form: APICourseRequest) => {

        try {
            const id = form.id;
            delete form.id;

            const resp = await fetch(
                `/api/courses/${id}`, {
                method: 'put',
                body: JSON.stringify(form),
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })

            if (resp.ok) {
                await fetchCourses()
            } else {
                const errorData = await resp.json();
                console.error(`Error ${resp.status}: ${errorData.message || 'Unknown error'}`);
            }

        } catch (error) {
            if (error instanceof Error) {
                console.error(error.message);
            } else {
                console.error("An unknown error occured while attempting to update course");
            }
        }
    }

    const insert = async (form: APICourseRequest) => {

        try {

            const resp = await fetch(
                `/api/courses/`, {
                method: 'post',
                body: JSON.stringify(form),
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })

            if (resp.ok) {
                await fetchCourses()
            } else {
                const errorData = await resp.json();
                console.error(`Error ${resp.status}: ${errorData.message || 'Unknown error'}`);
            }

        } catch (error) {
            if (error instanceof Error) {
                console.error(error.message);
            } else {
                console.error("An unknown error occured while attempting to create course");
            }
        }
    }

    return {
        courses, levelOptions, selected,
        fetchCourses, update, insert
    };
});
