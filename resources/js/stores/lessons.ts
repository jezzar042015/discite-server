import { APILessonArrayItem } from "@/types/lesson";
import { defineStore } from "pinia";
import { ref } from "vue";

export const useLessonsStore = defineStore('lessons', () => {

    const lessons = ref<APILessonArrayItem[]>([])
    const module_id = ref<string | null>(null)

    const fetchByModule = async (id: string) => {
        module_id.value = id;

        try {
            const resp = await fetch(`/api/modules/${module_id.value}/lessons`);

            if (!resp.ok) {
                throw new Error(`Response status: ${resp.status}`)
            }

            lessons.value = (await resp.json()).lessons;
        } catch (error: unknown) {
            if (error instanceof Error) {
                console.error(error.message);
            } else {
                console.error("An unknown error occured while fetching the lessons by moduleId");
            }
        }
    }

    return {
        lessons,
        module_id,
        fetchByModule
    }
})