<template>
    <CardHolder>
        <template #title>
            <div class="font-semibold text-red-600">
                Recent Lessons
            </div>
                
        </template>
        <template #body>
            <div class="flex flex-col gap-2">

                <div v-for="r in lessons.recents" :key="r.id">
                    <div>
                        {{ r.title }}
                    </div>
                    <div class="text-xs">
                        {{ r.overview }}
                    </div>
                </div>
            </div>
            <!-- <pre class="text-xs">
                {{ lessons.recents }}
            </pre> -->
        </template>
    </CardHolder>
</template>

<script setup lang="ts">
    import CardHolder from '@/components/dashboard/CardHolder.vue'
    import { onMounted } from 'vue';
    import { useLessonsStore } from '@/stores/lessons';

    const lessons = useLessonsStore();

    onMounted(async () => {
        await lessons.getRecent()
    })
</script>
