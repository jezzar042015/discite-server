<template>
    <div v-if="isVisible"
        class="absolute right-3 top-10 bg-gray-100/85 dark:bg-gray-700 w-fit h-fit px-0 py-1 shadow z-10 rounded-sm whitespace-nowrap transition duration-300">

        <router-link to="/me">
            <div
                class="px-6 py-3 flex gap-4 items-center cursor-pointer hover:bg-white dark:hover:bg-gray-800 ease-in-out transition duration-300">
                <i class="pi pi-user text-black dark:text-white/60"></i>
                <button @click.stop="profileView"> My Profile </button>
            </div>
        </router-link>

        <div
            class="px-6 py-3 flex gap-4 items-center cursor-pointer hover:bg-white dark:hover:bg-gray-800 ease-in-out transition duration-300">
            <i class="pi pi-sign-out text-black dark:text-white/60"></i>
            <button @click.prevent="logout"> Log Out </button>
        </div>

    </div>
</template>

<script setup lang="ts">
    import { useUserStore } from '@/stores/user';

    const { isVisible = false } = defineProps<{
        isVisible: boolean
    }>();

    const auth = useUserStore()

    const profileView = async () => {

    }

    const logout = async () => {
        await auth.logout()
        window.location.href = '/'
    }
</script>
