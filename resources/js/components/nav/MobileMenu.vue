<template>
    <div class="bg-white dark:bg-gray-900 absolute right-0 top-0">
        <div class="flex flex-col w-screen h-dvh">
            <!-- copycat header -->
            <div class="py-3 px-5 flex justify-between items-center w-full text-sm">
                <div class="font-bold uppercase flex gap-0 items-center">
                    <img class="h-7 -mt-1" src="@/assets/app-logo.png" alt="">
                    <span>{{ app.APPNAME }}</span>
                </div>

                <div @click.stop="closeMenu">
                    <i class="pi pi-times text-black dark:text-white h-6"></i>
                </div>
            </div>

            <div class="py-4 flex-1 flex flex-col justify-between border-t dark:border-t-slate-700 ">
                <div>
                    <router-link to="/dashboard" v-if="route.name != 'Dashboard'">
                        <div class="px-6 py-3 flex gap-4 items-center">
                            <i class="pi pi-objects-column text-black dark:text-white/60"></i>
                            <span> Dashboard </span>
                        </div>
                    </router-link>

                    <div class="px-6 py-3 flex gap-4 items-center">
                        <i class="pi pi-user text-black dark:text-white/60"></i>
                        <span> Your Profile </span>
                    </div>

                    <router-link to="/courses" v-if="route.name != 'Courses'">
                        <div class="px-6 py-3 flex gap-4 items-center">
                            <i class="pi pi-book text-black dark:text-white/60"></i>
                            <div class="flex items-center justify-between w-full">
                                <span> Courses </span>
                                <i class="pi pi-angle-right text-black dark:text-white/60"></i>
                            </div>
                        </div>
                    </router-link>

                </div>
                <div>
                    <div class="px-6 py-3 flex gap-4 items-center">
                        <i class="pi pi-sign-out text-black dark:text-white/60"></i>
                        <button @click.prevent="logout"> Log Out </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { useAppStore } from '@/stores/app';
    import { useUserStore } from '@/stores/user';
    import { useRoute } from 'vue-router'
    const emits = defineEmits(['hide-mobile-menu']);
    const route = useRoute()
    const userStore = useUserStore();
    const app = useAppStore()

    const closeMenu = () => {
        emits('hide-mobile-menu');
    }

    const logout = async () => {
        await userStore.logout()
        window.location.href = '/'
    }
</script>
