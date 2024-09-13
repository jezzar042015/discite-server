<template>
    <div class="bg-white dark:bg-gray-900 absolute right-0 top-0">
        <div class="flex flex-col w-screen h-dvh">


            <div class="py-3 px-5 flex justify-between items-center w-full text-sm">
                <AppName />
                <div @click.stop="closeMenu">
                    <i class="pi pi-times text-black dark:text-white h-6"></i>
                </div>
            </div>

            <div class="py-4 flex-1 flex flex-col justify-between border-t dark:border-t-slate-700 ">
                <div>
                    <div class="flex gap-4 items-center pl-4 mb-4">
                        <AvatarIcon class="h-8 w-8" />
                        Hi {{ userStore.welcomeName }}!
                    </div>

                    <MobileMenuLink :link-name="'Dashboard'" :route-to="'/dashboard'" :check-name="'Dashboard'"
                        :pi-icon="'pi-objects-column'" :guard="true" />

                    <MobileMenuLink :link-name="'My Profile'" :route-to="'/me'" :check-name="'Profile'"
                        :pi-icon="'pi-user'" :guard="true" />

                    <MobileMenuLink :link-name="'Courses'" :route-to="'/courses'" :check-name="'Courses'"
                        :pi-icon="'pi-book'" :guard="userStore.canBrowse" />

                    <MobileMenuLink :link-name="'Users'" :route-to="'/users'" :check-name="'Users'"
                        :pi-icon="'pi-users'" :guard="userStore.isAdmin" />

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
    import { useUserStore } from '@/stores/user';
    import { useRoute } from 'vue-router'
    import AppName from '@/components/nav/AppName.vue'
    import AvatarIcon from '@/assets/AvatarIcon.vue';
    import MobileMenuLink from '@/components/nav/MobileMenuLink.vue'

    const emits = defineEmits(['hide-mobile-menu']);
    const route = useRoute()
    const userStore = useUserStore();

    const closeMenu = () => {
        emits('hide-mobile-menu');
    }

    const logout = async () => {
        await userStore.logout()
        window.location.href = '/'
    }
</script>
