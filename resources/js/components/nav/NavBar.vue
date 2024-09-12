<template>
    <div class="fixed left-0 top-0 shadow-lg w-full bg-white/90 dark:bg-slate-900 z-10">
        <div class="m-auto flex w-full md:max-w-6xl">
            <div class="py-3 px-5 flex justify-between items-center w-full md:min-w-full text-sm">
                <div class="font-bold uppercase flex gap-0 items-center">
                    <img class="h-7 -mt-1" src="@/assets/app-logo.png" alt="">
                    <span>{{ app.APPNAME }}</span>
                </div>

                <div class="flex items-center gap-4">

                    <div class="md:hidden overflow-visible" @click="showMobileMenu">
                        <i class="pi pi-bars text-black dark:text-white h-6"></i>
                        <MobileMenu v-if="mobileMenu" @hide-mobile-menu="hideMobileMenu" />
                    </div>

                    <div class="hidden md:flex mr-12">
                        <ul class="flex gap-2 items-center">

                            <li class="py-1 px-4">
                                <router-link :to="{ name: 'Dashboard' }">Dashboard</router-link>
                            </li>

                            <li @click="coursesMdMenu = !coursesMdMenu"
                                class="relative py-1 px-4 flex items-center gap-2 cursor-pointer">
                                <span> Courses </span>
                                <i class="pi pi-angle-down text-black dark:text-white"></i>
                                <div ref="target" v-if="coursesMdMenu"
                                    class="absolute right-3 top-10 bg-white dark:bg-gray-700 w-fit h-fit px-0 py-2 shadow-xl z-10 rounded-sm whitespace-nowrap transition duration-300">
                                    <CourseList />
                                </div>

                            </li>
                        </ul>
                    </div>
                    
                    <div class="hidden md:flex items-center gap-2">
                        <span>Hi Jezreel!</span>
                        <span class="h-8 w-8">
                            <AvatarIcon class="h-8 w-8" />
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup lang="ts">
    import AvatarIcon from '@/assets/AvatarIcon.vue'
    import CourseList from '@/components/nav/CourseList.vue'
    import MobileMenu from '@/components/nav/MobileMenu.vue'
    import { useAppStore } from '@/stores/app';
    import { ref } from 'vue';
    import { onClickOutside } from '@vueuse/core'

    const app = useAppStore();

    const coursesMdMenu = ref(false)
    const target = ref(null)

    onClickOutside(target, (event) => {
        coursesMdMenu.value = false
    });

    const mobileMenu = ref(false)
    const hideMobileMenu = () => {
        mobileMenu.value = false
    }

    const showMobileMenu = () => {
        mobileMenu.value = true
    }
</script>

<style scoped></style>