import { APIModuleArrayItem } from "@/types/module";
import { defineStore } from "pinia";
import { ref } from "vue";

export const useModulesStore = defineStore('modules', () => {

    const modules = ref<APIModuleArrayItem[]>([]);
    const course_id = ref<string | null>(null)

    const fetchModules = async (id: string) => {

        course_id.value = id;

        try {
            const resp = await fetch(`/api/courses/${course_id.value}`);
            if (!resp.ok) {
                throw new Error(`Response status: ${resp.status}`);
            }
            modules.value = (await resp.json()).data.modules;

        } catch (error: unknown) {
            if (error instanceof Error) {
                console.error(error.message);
            } else {
                console.error("An unknown error occured");
            }
        }
    }

    return {
        modules,
        course_id,
        fetchModules
    }
})