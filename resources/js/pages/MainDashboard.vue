<template>
    <Authenticated>

        <template #header>
            <div class="flex flex-col gap-10 items-center w-full mt-6">
                <div>
                    <div
                        class="h-52 w-52 bg-white dark:bg-gray-800 flex flex-col gap-3 items-center justify-center rounded-full shadow">
                        <img class="h-28 -mt-5" src="@/assets/app-logo.png" alt="">
                        <h2 class="text uppercase font-semibold">{{ app.APPNAME }}</h2>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 grid-rows-2 gap-4">
                    <div class="bg-white dark:bg-gray-700 p-6 rounded-lg">
                        <router-link :to="{ name: 'Courses' }">View {{ courseStore.courses.length }}
                            Courses</router-link>
                    </div>
                    <div class="bg-white dark:bg-gray-700 p-6 rounded-lg">
                        <h3>Write interactively!</h3>
                        <p></p>
                    </div>
                </div>
            </div>
        </template>
    </Authenticated>
</template>

<script setup lang="ts">
    import Authenticated from '@/layouts/Authenticated.vue';
    import { useAppStore } from '@/stores/app';
    import { useCoursesStore } from '@/stores/courses';

    const app = useAppStore()
    const courseStore = useCoursesStore()
</script>
