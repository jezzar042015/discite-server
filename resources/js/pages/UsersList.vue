<template>
    <Authenticated :is-fetching="isFetching">
        <template #header>
            <div
                class="flex justify-between items-center min-w-full px-2 text-lg font-extrabold text-sky-700 uppercase dark:text-sky-500 cursor-pointer">
                <h3 @click="refreshUsers">Users &bullet; <span>{{ userStore.users.length }}</span></h3>
            </div>
        </template>

        <template #items-list>
            <div class="flex gap-2 w-full">
                <div class="flex-1">
                    <IconField fluid>
                        <InputIcon class="pi pi-search" />
                        <InputText v-model="keywords" placeholder="Search" fluid variant="filled" />
                    </IconField>
                </div>

                <div
                    class="w-24 flex items-center gap-3 bg-white dark:bg-gray-900 px-3 rounded-md text-gray-600 dark:text-gray-400 shadow-sm cursor-pointer">
                    <span><i class="pi pi-sliders-h" /></span>
                    <span class="text-xs">FILTER</span>
                </div>
            </div>
            <div class="grid grid-flow-row-dense row grid-cols-1 sm:grid-cols-2 gap-2 w-full">
                <template v-for="user in filtered" :key="user.id">
                    <UserItem :user="user" />
                </template>
            </div>

            <div v-if="filtered.length === 0"
                class="flex flex-col gap-4 bg-white/50 dark:bg-gray-900/50 p-10 rounded-lg w-full text-center shadow">
                <i class="pi pi-exclamation-circle text-sky-700/50 dark:text-sky-700" style="font-size: 4em;"></i>
                <p v-if="keywords">Can't find the user you are looking for!</p>
                <p v-else>No active users found in the app</p>
            </div>
        </template>
    </Authenticated>
</template>

<script setup lang="ts">
    import Authenticated from '@/layouts/Authenticated.vue'
    import UserItem from '@/components/UserItem.vue';
    import IconField from 'primevue/iconfield';
    import InputIcon from 'primevue/inputicon';
    import InputText from 'primevue/inputtext';
    import { useUserStore } from '@/stores/user';
    import { onMounted, ref, computed } from 'vue';

    const keywords = ref('');
    const isFetching = ref(false);
    const userStore = useUserStore();

    const filtered = computed(() => {
        if (userStore.users.length == 0) return []
        if (!keywords.value) return userStore.users

        const list = userStore.users.filter(user => {
            return user.name.toLowerCase().includes(keywords.value.toLowerCase())
        });

        return list ?? []
    })

    const refreshUsers = async () => {
        isFetching.value = true
        await userStore.getUsers()
        isFetching.value = false
    }

    onMounted(async () => {
        await refreshUsers();
    })
</script>
