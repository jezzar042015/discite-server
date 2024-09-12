import { get, post, put } from "@/composables/server";
import { APILessonArrayItem, APILessonRequest } from "@/types/lesson";
import { defineStore } from "pinia";
import { ref } from "vue";
import { useRoute } from 'vue-router';

export const useLessonsStore = defineStore('lessons', () => {

    const lessons = ref<APILessonArrayItem[]>([])
    const module_id = ref<string | null>(null)
    const active_id = ref<string | null>(null)
    const selected = ref<APILessonArrayItem | null>(null)
    const router = useRoute();

    const fetchById = async () => {
        const id = router.params.id.toString()
        active_id.value = id;        
        const resp = await get(`/api/lessons/${id}`);
        const lesson = (await resp?.json())?.data || null;
        if (lesson) selected.value = lesson
    }

    const fetchByModule = async (id: string) => {
        module_id.value = id;
        const resp = await get(`/api/modules/${module_id.value}/lessons`);
        lessons.value = (await resp?.json())?.lessons || [];
    }

    const update = async (form: APILessonRequest) => {
        if (!active_id.value) return
        const url = `/api/lessons/${active_id.value}`
        await put(url, JSON.stringify(form));
        await fetchById();
    }
    const insert = async (form: APILessonRequest) => {
        const url = `/api/lessons`
        await post(url, JSON.stringify(form));
        await fetchById();
    }

    return {
        lessons, selected,
        active_id, module_id,
        fetchByModule, fetchById, update, insert
    }
})