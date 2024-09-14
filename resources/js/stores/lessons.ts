import { get, post, put } from "@/composables/server";
import { APILessonArrayItem, APILessonRequest } from "@/types/lesson";
import { OutputData } from "@editorjs/editorjs";
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
        if (lesson) {
            lesson.content = JSON.parse(lesson.content)
            selected.value = lesson
        }
    }

    const fetchByModule = async (id: string) => {
        module_id.value = id;
        const resp = await get(`/api/modules/${module_id.value}/lessons`);
        const data = (await resp?.json()) || [];
        lessons.value = data?.lessons || []
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

    const saveContent = async (id: string, content: OutputData) => {
        const url = `/api/lesson-content`;
        await post(
            url,
            JSON.stringify({ id, content })
        );

        if (selected.value) selected.value.content = content 
    }

    return {
        lessons, selected,
        active_id, module_id,
        fetchByModule, fetchById, update, insert, saveContent
    }
})