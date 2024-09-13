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
    const course_id = ref('')
    const router = useRoute()

    const fetchModules = async () => {
        const url = `/api/courses/${course_id.value}`
        const resp = await get(url);
        const course = (await resp?.json())?.data || null;
        modules.value = course ? course.modules : []
        courseStore.selected = course
    }

    const setParentId = async () => {
        course_id.value = courseStore.selected ? courseStore.selected.id : router.params.id.toString();
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
        modules, selected, course_id,
        setParentId, fetchModules, update, insert
    }
})