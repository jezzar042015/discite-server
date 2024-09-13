<template>
    <div
        class="flex flex-col gap-3 bg-white p-4 rounded-md md:min-w-full shadow hover:shadow-lg dark:bg-gray-900 dark:shadow-md dark:shadow-black/40">
        <div class="font-semibold text-sky-700 text-sm flex gap-2 items-center dark:text-sky-500">
            <i class="pi pi-book"></i>
            {{ course.title }}
        </div>

        <!-- course badges -->
        <div class="w-fit flex gap-2 flex-wrap">

            <ChipHolder>
                <i class="pi pi-gauge" style="font-size: .8rem;"></i>
                <span>{{ course.level }}</span>
            </ChipHolder>

            <ChipHolder>
                <i v-if="course.is_premium" class="pi pi-credit-card" style="font-size: .8rem;"></i>
                <i v-else class="pi pi-unlock" style="font-size: .8rem;"></i>
                <span class="uppercase"> {{ course.is_premium ? 'premium' : 'free' }} access</span>
            </ChipHolder>

            <ChipHolder>
                <i v-if="course.publish" class="pi pi-cloud" style="font-size: .8rem;"></i>
                <i v-else class="pi pi-file" style="font-size: .8rem;"></i>
                <span class="uppercase">{{ course.publish ? 'published' : 'unpublished' }}</span>
            </ChipHolder>
            
        </div>

        <div class="text-sm">
            {{ course.description }}
        </div>

        <div class="flex gap-4">
            <button @click="navigateModules"
                class="inline text-xs py-1 px-3 bg-sky-400/10 rounded-md dark:bg-sky-400/15 cursor-pointer shadow">
                {{ modulesLink }}
            </button>
            <button @click="update"
                class="inline text-xs py-1 px-3 bg-sky-400/10 rounded-md hover:bg-sky-400/30 ease-out duration-300 dark:bg-sky-400/15 shadow">
                Make Changes
            </button>
        </div>

    </div>
</template>

<script setup lang="ts">
    import { APICourseArrayItem } from '@/types/course';
    import { useCoursesStore } from '@/stores/courses';
    import { computed } from 'vue';
    import { useRouter } from 'vue-router';
    import ChipHolder from '@/components/ChipHolder.vue'


    const { course } = defineProps<{ course: APICourseArrayItem }>();
    const emits = defineEmits(['make-changes'])

    const router = useRouter();
    const courseStore = useCoursesStore();
    const modulesLink = computed(() => {
        const modulesCount = course.modules_count
        return modulesCount == 0 ? 'Start Adding Modules' : `See Course ${modulesCount} Modules`
    })

    const navigateModules = async () => {
        courseStore.selected = course;
        router.push(`/courses/${course.id}/modules`)
    }

    const update = () => {
        courseStore.selected = course;
        emits('make-changes', course)
    }
</script>
