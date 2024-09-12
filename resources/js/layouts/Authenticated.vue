<template>
    <div
        class="jtbg px-2 pb-6 md:p-4 bg-gray-100 min-h-screen overflow-y-auto dark:bg-gray-800 flex flex-col items-center">

        <!-- navbar -->
        <div class="fixed left-0 top-0 shadow-lg w-full bg-white/90 dark:bg-slate-900 z-10">
            <div class="m-auto flex w-full md:max-w-6xl">
                <div class="py-3 px-5 flex justify-between items-center w-full md:min-w-full text-sm">
                    <div class="font-bold uppercase flex gap-0 items-center">
                        <img class="h-7 -mt-1" src="./../assets/app-logo.png" alt="">
                        <span>Discite</span>
                    </div>

                    <div class="flex flex-col gap-4">
                        <div class="md:hidden">
                            <i class="pi pi-bars text-black dark:text-white h-6"></i>
                        </div>
                        <div class="hidden md:flex">
                            <ul class="flex gap-2 items-center">
                                <li class="py-1 px-4">
                                    <router-link :to="{ name: 'Dashboard' }">Dashboard</router-link>
                                </li>
                                <li class="py-1 px-4 flex items-center gap-2 cursor-pointer ">
                                    <span> Courses </span>
                                    <i class="pi pi-angle-down text-black dark:text-white"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- top margin spacer -->
        <div class="mt-14 md:mt-10 "></div>


        <div v-if="!isFetching"
            class="w-full flex flex-col justify-start items-center md:py-6 md:px-16 md:max-w-6xl gap-4">
            <slot name="parent-info"></slot>
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

<style scoped>
    @media (prefers-color-scheme: light)
    {
        .jtbg
        {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%232C6A93"><path d="M0 1v99c134.3 0 153.7-99 296-99H0Z" opacity=".5"></path><path d="M1000 4v86C833.3 90 833.3 3.6 666.7 3.6S500 90 333.3 90 166.7 4 0 4h1000Z" opacity=".5"></path><path d="M617 1v86C372 119 384 1 196 1h421Z" opacity=".5"></path><path d="M1000 0H0v52C62.5 28 125 4 250 4c250 0 250 96 500 96 125 0 187.5-24 250-48V0Z"></path></svg>');
            background-attachment: fixed;
            background-size: cover;
            background-blend-mode: color-burn;
        }
    }

    @media (prefers-color-scheme: dark)
    {
        .jtbg
        {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%23042E41"><path d="M0 1v99c134.3 0 153.7-99 296-99H0Z" opacity=".5"></path><path d="M1000 4v86C833.3 90 833.3 3.6 666.7 3.6S500 90 333.3 90 166.7 4 0 4h1000Z" opacity=".5"></path><path d="M617 1v86C372 119 384 1 196 1h421Z" opacity=".5"></path><path d="M1000 0H0v52C62.5 28 125 4 250 4c250 0 250 96 500 96 125 0 187.5-24 250-48V0Z"></path></svg>');
            background-attachment: fixed;
            background-size: cover;
        }
    }
</style>