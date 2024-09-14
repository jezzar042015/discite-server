<template>
    <div class="bg-white dark:bg-gray-950 shadow dark:shadow-md dark:shadow-black/40 rounded-md">
        <div class="py-2 px-4 leading-tight relative">
            <div class="font-bold text-sm md:text-base">
                <span>{{ user.name }}</span>
            </div>
            <div>
                <span class="text-xs dark:text-gray-400">{{ user.email }}</span>
            </div>

            <div @click="showRoleSelector = !showRoleSelector"
                class="absolute right-2 top-2 text-xs py-1 px-3 capitalize rounded-full bg-emerald-300 dark:bg-emerald-300/80 cursor-pointer">
                <div class="relative flex items-center gap-1 text-gray-700">
                    <i v-if="user.type == 'admin'" class="pi pi-shield" style="font-size: .85em;"></i>
                    <i v-if="user.type == 'dev'" class="pi pi-code" style="font-size: .85em;"></i>
                    <i v-if="user.type == 'author'" class="pi pi-pencil" style="font-size: .85em;"></i>
                    <i v-if="user.type == 'student'" class="pi pi-lightbulb" style="font-size: .85em;"></i>
                    <span class="text-xs">{{ user.type }}</span>
                    <UserRoleSeletor :visible="showRoleSelector" :current-role="user.type" @hide-selector="hideSelector"
                        @assign-role="updateUserRole" />
                </div>
            </div>

        </div>
    </div>
</template>

<script setup lang="ts">
    import { APIUser } from '@/types/user';
    import { UserType } from '@/types/user';
    import UserRoleSeletor from '@/components/UserRoleSelector.vue'
    import { ref } from 'vue';
    import { useUserStore } from '@/stores/user';

    const userStore = useUserStore()

    const { user } = defineProps<{
        user: APIUser
    }>()

    const showRoleSelector = ref(false)
    const hideSelector = () => showRoleSelector.value = false;

    const updateUserRole = async (role: UserType) => {
        user.type = role
        await userStore.assignRole(user.id, role)
    }
</script>
