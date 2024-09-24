<template>
    <CardHolder>
        <template #title>
            <div class="uppercase text-sm">
                Recent Lessons
            </div>
            <hr>
        </template>
        <template #body>
            <div class="flex flex-col gap-2">

                <div class="cursor-pointer" v-for="r in lessons.recents" :key="r.id" @click="gotoLesson(r.id)">
                    <div class="text-base font-semibold text-sky-600">
                        {{ r.title }}
                    </div>
                    <div class="text-xs">
                        {{ r.overview }}
                    </div>
                    <div class="text-xs italic pt-1 pb-2 text-gray-600">
                        Updated {{ displayLastUpdate(r.updated_at) }}
                    </div>
                    <hr>
                </div>
            </div>
        </template>
    </CardHolder>
</template>

<script setup lang="ts">
    import CardHolder from '@/components/dashboard/CardHolder.vue'
    import { onMounted } from 'vue';
    import { useLessonsStore } from '@/stores/lessons';
    import { useTimeAgo } from '@vueuse/core'
    import { useRouter } from 'vue-router';

    const lessons = useLessonsStore();
    const router = useRouter()

    const displayLastUpdate = (updated: string) => {
        return useTimeAgo(new Date(updated))
    }

    const gotoLesson = (id: string) => {
        router.push(`/lessons/${id}`);
    }

    onMounted(async () => {
        await lessons.getRecent()
    })
</script>
