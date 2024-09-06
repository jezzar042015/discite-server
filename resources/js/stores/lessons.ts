import { APILessonArrayItem } from "@/types/lesson";
import { defineStore } from "pinia";
import { computed, ref } from "vue";

export const useLessonsStore = defineStore('lessons', () => {

    const lessons = ref<APILessonArrayItem[]>([])
    const module_id = ref<string | null>(null)
    const active_id = ref<string | null>(null)

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

    const selected = computed(() => {
        if (!active_id.value) {
            return null
        }
        return lessons.value.find(f => f.id == active_id.value)
    })

    return {
        lessons, selected,
        active_id, module_id,
        fetchByModule
    }
})