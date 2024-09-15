<template>
    <div
        class="jtbg relative px-2 pb-6 md:p-4 bg-gray-100 min-h-screen overflow-y-auto dark:bg-gray-800 flex flex-col items-center">

        <!-- navbar -->
        <NavBar />
        <!-- top margin spacer -->
        <div class="mt-14 md:mt-10 "></div>


        <div v-if="!isFetching"
            class="w-full flex flex-col justify-start items-center md:py-6 md:px-16 md:max-w-6xl gap-4">
            <slot name="parent-info"></slot>
            <slot name="header"></slot>
            <slot name="items-list"></slot>
        </div>

        <div v-else class="flex flex-col flex-1 items-center justify-center min-w-80 min-h-full p-20 ">
            <CircleLoader class="" />
        </div>

        <slot name="form">

        </slot>
    </div>
</template>

<script setup lang="ts">
    import CircleLoader from '@/assets/CircleWave.vue'
    import NavBar from '@/components/nav/NavBar.vue'
    import { onMounted } from 'vue';
    import { useCoursesStore } from '@/stores/courses';
    import { useUserStore } from '@/stores/user';
    import { useRoute } from 'vue-router';

    defineProps({
        isFetching: {
            type: Boolean,
            default: false
        }
    });

    const route = useRoute()
    const courseStore = useCoursesStore()
    const authStore = useUserStore()

    onMounted(async () => {
        if (!authStore.current) await authStore.getCurrent();

        if(!['Courses'].includes(route.name as string))
            await courseStore.fetchCourses()
    })
</script>

<style scoped>
    @media (prefers-color-scheme: light)
    {
        .jtbg
        {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%233B4D56"><path d="M0 1v99c134.3 0 153.7-99 296-99H0Z" opacity=".5"></path><path d="M1000 4v86C833.3 90 833.3 3.6 666.7 3.6S500 90 333.3 90 166.7 4 0 4h1000Z" opacity=".5"></path><path d="M617 1v86C372 119 384 1 196 1h421Z" opacity=".5"></path><path d="M1000 0H0v52C62.5 28 125 4 250 4c250 0 250 96 500 96 125 0 187.5-24 250-48V0Z"></path></svg>');
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