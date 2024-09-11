<template>
    <div class="p-2 md:p-4 bg-gray-100 overflow-y-hidden dark:bg-gray-800 flex flex-col items-center">

        <!-- fixed header -->
        <div class="fixed left-0 top-0 shadow-lg w-full bg-white dark:bg-slate-900 z-10">
            <div class="m-auto flex w-full md:max-w-6xl">
                <div class="py-3 px-5 flex justify-between items-center w-full md:min-w-full text-sm">
                    <div>
                        <h2 class="font-bold uppercase ">Discite</h2>
                    </div>

                    <div class="flex flex-col gap-4">
                        <router-link :to="{ name: 'Dashboard' }">Dashboard</router-link>
                    </div>
                </div>
            </div>
        </div>


        <!-- top margin spacer -->
        <div class="mt-14 md:mt-10 "></div>

        <!-- <div class="w-full md:max-w-6xl p-2 md:px-16 rounded">
            <p></p>
        </div> -->

        <div v-if="!isFetching" class="flex flex-col justify-center items-center md:py-6 md:px-16 md:max-w-6xl gap-4">
            <slot name="header"></slot>
            <slot name="items-list"></slot>
        </div>

        <div v-else class="min-h-screen min-w-80 h-full p-20 grid place-items-center">
            <CircleLoader class="-mt-32" />
        </div>

        <slot name="form">

        </slot>
    </div>
</template>

<script setup lang="ts">
    import CircleLoader from '@/components/loaders/CircleWave.vue'

    defineProps({
        isFetching: {
            type: Boolean,
            default: false
        }
    });
</script>