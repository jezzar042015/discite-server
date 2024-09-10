<template>
    <div class="flex flex-col gap-3 bg-white p-4 rounded-md shadow hover:shadow-lg">
        <div class="font-semibold text-sky-700 flex gap-2 items-center ">
            <i class="pi pi-book"></i>
            {{ course.title }}
        </div>

        <div class="w-fit flex gap-4">
            <div class="flex gap-2 items-center text-xs py-1 px-3 bg-sky-400/10 rounded-xl">
                <i class="pi pi-gauge" style="font-size: .8rem;"></i>
                {{ course.level }}
            </div>

            <div class="flex gap-2 items-center text-xs py-1 px-3 bg-sky-400/10 rounded-xl uppercase">
                <i v-if="course.is_premium" class="pi pi-credit-card" style="font-size: .8rem;"></i>
                <i v-else class="pi pi-unlock" style="font-size: .8rem;"></i>
                {{ course.is_premium ? 'premium' : 'free' }} access
            </div>

            <div class="flex gap-2 items-center text-xs py-1 px-3 bg-sky-400/10 rounded-xl uppercase">
                <i v-if="course.publish" class="pi pi-cloud" style="font-size: .8rem;"></i>
                <i v-else class="pi pi-file" style="font-size: .8rem;"></i>
                {{ course.publish ? 'published' : 'unpublished' }}
            </div>
        </div>

        <div class="text-sm">
            {{ course.description }}
        </div>

        <div class="flex gap-4">
            <router-link :to="`/courses/${course.id}/modules`">
                <div class="inline text-xs py-1 px-3 bg-sky-400/10 rounded-md">
                    {{ modulesLink }}
                </div>
            </router-link>
            <button @click="update"
                class="inline text-xs py-1 px-3 bg-sky-400/10 rounded-md hover:bg-sky-400/30 ease-out duration-300">
                Make Changes
            </button>
        </div>

    </div>
</template>

<script setup lang="ts">
    import { APICourseArrayItem } from '@/types/course';
    import { computed } from 'vue';

    const props = defineProps<{ course: APICourseArrayItem }>();
    const emits = defineEmits(['make-changes'])

    const modulesLink = computed(() => {
        const modulesCount = props.course.modules_count
        return modulesCount == 0 ? 'Start Adding Modules' : `See Course ${modulesCount} Modules`
    })

    const update = () => {
        emits('make-changes', props.course)
    }
</script>
