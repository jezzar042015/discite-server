<template>
    <div class="fixed left-0 top-0 shadow-lg w-full bg-white/90 dark:bg-slate-900 z-10">
        <div class="m-auto flex w-full md:max-w-6xl">
            <div class="py-3 px-5 flex justify-between items-center w-full md:min-w-full text-sm">

                <AppName />

                <div class="flex items-center gap-4">

                    <div class="md:hidden overflow-visible" @click="showMobileMenu">
                        <i class="pi pi-bars text-black dark:text-white h-6"></i>
                        <MobileMenu v-if="mobileMenu" @hide-mobile-menu="hideMobileMenu" />
                    </div>

                    <div v-if="authStore.canBrowse" class="hidden md:flex mr-12">
                        <ul class="flex gap-2 items-center">

                            <WebNavLink router-to-name="Dashboard" nav-display-name="Dashboard" />

                            <WebNavLink v-if="authStore.isAdmin" router-to-name="Users" nav-display-name="Users" />

                            <li v-if="courseStore.courses.length > 0" class="py-1 px-4 border-b-2 border-transparent">
                                <div @click="coursesWebMenu = !coursesWebMenu" class="relative">

                                    <span class=" flex items-center gap-2 cursor-pointer">
                                        <span> Courses </span>
                                        <i class="pi pi-angle-down text-black dark:text-white"></i>
                                    </span>
                                    <CourseList ref="courseWebMenuTarget" :is-visible="coursesWebMenu" />

                                </div>
                            </li>

                        </ul>
                    </div>

                    <div @click.stop="profileWebMenu = !profileWebMenu"
                        class="relative hidden md:flex items-center gap-2 cursor-pointer transition ease-in-out duration-200">
                        <span>Hi {{ authStore.welcomeName }}!</span>
                        <span class="h-8 w-8">
                            <AvatarIcon class="h-8 w-8" />
                        </span>

                        <ProfileWebMenu ref="profileWebMenuTarget" :is-visible="profileWebMenu" />
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
    import ProfileWebMenu from '@/components/nav/ProfileWebMenu.vue'
    import AppName from '@/components/nav/AppName.vue'
    import WebNavLink from '@/components/nav/WebNavLink.vue'

    import { ref } from 'vue';
    import { onClickOutside } from '@vueuse/core'
    import { useUserStore } from '@/stores/user'
    import { useCoursesStore } from '@/stores/courses'

    const authStore = useUserStore()
    const courseStore = useCoursesStore()

    const coursesWebMenu = ref(false)
    const courseWebMenuTarget = ref(null)

    onClickOutside(courseWebMenuTarget, (event) => {
        coursesWebMenu.value = false
    });

    const profileWebMenu = ref(false);
    const profileWebMenuTarget = ref(null)

    onClickOutside(profileWebMenuTarget, (event) => {
        profileWebMenu.value = false
    });

    const mobileMenu = ref(false)
    const hideMobileMenu = () => {
        mobileMenu.value = false
    }

    const showMobileMenu = () => {
        mobileMenu.value = true
    }
</script>
