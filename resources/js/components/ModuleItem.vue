<template>
    <div class="bg-white p-4 rounded-md shadow flex flex-col gap-2 ">
        <div>
            <div class="text-xs">
                MODULE {{ i + 1 }}
            </div>
        </div>

        <div class="font-semibold text-sky-700 flex gap-2 items-center ">
            <i class="pi pi-sitemap" style="font-size: .8rem;"></i>
            {{ module.title }}
        </div>
        
        <div class="w-fit flex gap-4 text-xs">
            <div class="flex gap-2 items-center text-xs py-1 px-3 bg-sky-400/10 rounded-xl uppercase">
                <i v-if="module.is_premium" class="pi pi-credit-card" style="font-size: .8rem;"></i>
                <i v-else class="pi pi-unlock" style="font-size: .8rem;"></i>
                {{ module.is_premium ? 'premium' : 'free' }} access
            </div>

            <div class="flex gap-2 items-center text-xs py-1 px-3 bg-sky-400/10 rounded-xl uppercase">
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

            <button
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
</script>
