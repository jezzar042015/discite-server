<template>
    <Authenticated :is-fetching="isFetching">
        <template #header>
            <div
                class="flex justify-between items-center min-w-full px-2 text-lg font-extrabold text-sky-700 uppercase dark:text-sky-500">
                <h3>Users</h3>
            </div>
        </template>

        <template #items-list>
            <div class="flex gap-2 w-full">
                <div class="flex-1">
                    <IconField fluid>
                        <InputIcon class="pi pi-search" />
                        <InputText v-model="keywords" placeholder="Search" fluid variant="filled"/>
                    </IconField>
                </div>

                <div class="w-24 flex items-center gap-3 bg-white dark:bg-gray-900 px-3 rounded-md text-gray-600 dark:text-gray-400 shadow-sm cursor-pointer">
                    <span><i class="pi pi-sliders-h"/></span>
                    <span class="text-xs">FILTER</span>
                </div>
            </div>
            <div class="grid grid-flow-row-dense row grid-cols-1 sm:grid-cols-2 gap-2 w-full">
                <template v-for="user in filtered" :key="user.id">
                    <UserItem :user="user" />
                </template>
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

    onMounted(async () => {
        isFetching.value = true
        await userStore.getUsers();
        isFetching.value = false
    })
</script>
