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

                <div v-if="auth.canBrowse" class="w-full grid grid-cols-1 grid-rows-2 gap-4">
                    <router-link :to="{ name: 'Courses' }">
                        <div class="flex gap-4 items-center bg-white dark:bg-gray-700 p-6 rounded-lg">
                            <i class="pi pi-book"></i>
                            Navigate Courses
                        </div>
                    </router-link>

                </div>

                <div class="text-center" v-else>
                    Hmmm! Contents in this site are for Admin company access only.
                </div>
            </div>
        </template>
    </Authenticated>
</template>

<script setup lang="ts">
    import Authenticated from '@/layouts/Authenticated.vue';
    import { useAppStore } from '@/stores/app';
    import { useCoursesStore } from '@/stores/courses';
    import { useUserStore } from '@/stores/user';

    const app = useAppStore()
    const auth = useUserStore()
    const courseStore = useCoursesStore()
</script>
