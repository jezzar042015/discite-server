<template>
    <div
        class="flex flex-col gap-1 bg-white/85 p-4 rounded-md md:min-w-full shadow hover:shadow-lg dark:bg-gray-900 dark:shadow-md dark:shadow-black/40">
        <div>
            <div class="text-xs">
                MODULE {{ i + 1 }}
            </div>
        </div>

        <div class="font-semibold text-sky-700 flex gap-2 items-center dark:text-sky-500">
            <!-- <i class="pi pi-sitemap" style="font-size: .8rem;"></i> -->
            {{ module.title }}
        </div>

        <div class="text-sm">
            {{ module.description }}
        </div>

        <div class="flex-1 py-2 flex flex-col gap-2">

            <div class="w-fit flex gap-2 text-xs">
                <ChipHolder>
                    <i v-if="module.is_premium" class="pi pi-credit-card" style="font-size: .8rem;"></i>
                    <i v-else class="pi pi-unlock" style="font-size: .8rem;"></i>
                    <span class="uppercase"> {{ module.is_premium ? 'premium' : 'free' }} access</span>
                </ChipHolder>

                <ChipHolder>
                    <i v-if="module.publish" class="pi pi-cloud" style="font-size: .8rem;"></i>
                    <i v-else class="pi pi-file" style="font-size: .8rem;"></i>
                    <span class="uppercase">{{ module.publish ? 'published' : 'unpublished' }}</span>
                </ChipHolder>
            </div>
        </div>

        <div class="flex gap-4">
            <router-link :to="`/modules/${module.id}/lessons`">
                <div
                    class="flex gap-2 items-center text-xs py-1 px-3 bg-sky-400/10 rounded-md hover:bg-sky-400/30 ease-out duration-300 shadow">
                    <i class="pi pi-sitemap" style="font-size: .8rem;"></i>
                    See Lessons
                </div>
            </router-link>

            <button @click="openUpdate"
                class="flex gap-2 items-center text-xs py-1 px-3 bg-sky-400/10 rounded-md hover:bg-sky-400/30 ease-out duration-300 shadow">
                <i class="pi pi-pencil" style="font-size: .7rem;"></i>
                Make Changes
            </button>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { useModulesStore } from '@/stores/modules';
    import { APIModuleArrayItem } from '@/types/module';
    import ChipHolder from './ChipHolder.vue';


    const { module, i } = defineProps<{
        module: APIModuleArrayItem,
        i: number
    }>();

    const moduleStore = useModulesStore()
    const emits = defineEmits(['make-changes'])

    const openUpdate = async () => {
        moduleStore.selected = module;
        emits('make-changes', module)
    }

</script>
