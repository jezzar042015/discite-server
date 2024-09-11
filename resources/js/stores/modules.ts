import { get, post, put } from "@/composables/server";
import { APIModuleArrayItem, APIModuleRequest } from "@/types/module";
import { defineStore } from "pinia";
import { ref } from "vue";
import { useCoursesStore } from "./courses";
import { useRoute } from "vue-router";

export const useModulesStore = defineStore('modules', () => {

    const modules = ref<APIModuleArrayItem[]>([]);
    const selected = ref<APIModuleArrayItem | null>(null);
    const courseStore = useCoursesStore();
    const router = useRoute()

    const fetchModules = async () => {
        const course_id = courseStore.selected ? courseStore.selected.id : router.params.id.toString();
        const url = `/api/courses/${course_id}`
        const resp = await get(url);
        modules.value = (await resp?.json())?.data?.modules || [];
    }

    const update = async (form: APIModuleRequest) => {
        await put(`/api/modules/${selected.value?.id}`, JSON.stringify(form));
        await fetchModules();
    }

    const insert = async (form: APIModuleRequest) => {
        await post(`/api/modules`, JSON.stringify(form));
        await fetchModules();
    }

    return {
        modules, selected,
        fetchModules, update, insert
    }
})