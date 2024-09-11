<template>
    <div
        class="flex flex-col gap-3 bg-white p-4 rounded-md md:min-w-full shadow hover:shadow-lg dark:bg-gray-900 dark:shadow-md dark:shadow-black/40">
        <div>
            <div class="text-xs">
                MODULE {{ i + 1 }}
            </div>
        </div>

        <div class="font-semibold text-sky-700 flex gap-2 items-center dark:text-sky-500">
            <i class="pi pi-sitemap" style="font-size: .8rem;"></i>
            {{ module.title }}
        </div>

        <div class="w-fit flex gap-4 text-xs">
            <div
                class="flex gap-2 items-center text-xs py-1 px-3 bg-sky-400/10 rounded-xl uppercase dark:bg-sky-400/15">
                <i v-if="module.is_premium" class="pi pi-credit-card" style="font-size: .8rem;"></i>
                <i v-else class="pi pi-unlock" style="font-size: .8rem;"></i>
                {{ module.is_premium ? 'premium' : 'free' }} access
            </div>

            <div
                class="flex gap-2 items-center text-xs py-1 px-3 bg-sky-400/10 rounded-xl uppercase dark:bg-sky-400/15">
                <i v-if="module.publish" class="pi pi-cloud" style="font-size: .8rem;"></i>
                <i v-else class="pi pi-file" style="font-size: .8rem;"></i>
                {{ module.publish ? 'published' : 'unpublished' }}
            </div>
        </div>

        <div class="text-sm">
            {{ module.description }}
        </div>

        <div class="flex gap-4">
            <router-link :to="`/modules/${module.id}/lessons`">
                <div class="flex gap-2 items-center text-xs py-1 px-3 bg-sky-400/10 rounded-md">
                    <i class="pi pi-sitemap" style="font-size: .8rem;"></i>
                    See Lessons
                </div>
            </router-link>

            <button @click="openUpdate"
                class="flex gap-2 items-center text-xs py-1 px-3 bg-sky-400/10 rounded-md hover:bg-sky-400/30 ease-out duration-300">
                <i class="pi pi-pencil" style="font-size: .7rem;"></i>
                Make Changes
            </button>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { APIModuleArrayItem } from '@/types/module';

    interface Props {
        module: APIModuleArrayItem,
        i: number
    }
    const props = defineProps<Props>()
    const emits = defineEmits(['make-changes'])
    const openUpdate = async () => {
        emits('make-changes', props.module)
    }

</script>
