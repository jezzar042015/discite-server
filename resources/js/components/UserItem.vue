<template>
    <div class="bg-white dark:bg-gray-950 shadow dark:shadow-md dark:shadow-black/40 rounded-md">
        <div class="py-2 px-4 leading-tight relative">
            <div class="font-bold text-sm md:text-base">
                <span>{{ user.name }}</span>
            </div>
            <div>
                <span class="text-xs dark:text-gray-400">{{ user.email }}</span>
            </div>

            <div class="absolute right-2 top-2 text-xs py-1 px-3 capitalize rounded-full bg-emerald-300 dark:bg-emerald-300/80">
                <div class="flex items-center gap-1 text-gray-700">
                    <i v-if="user.type == 'admin'" class="pi pi-shield" style="font-size: .85em;"></i>
                    <i v-if="user.type == 'student'" class="pi pi-lightbulb" style="font-size: .85em;"></i>
                    <span class="text-xs">{{ user.type }}</span>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup lang="ts">
    import { APIUser } from '@/types/user';
    const { user } = defineProps<{
        user: APIUser
    }>()


</script>
