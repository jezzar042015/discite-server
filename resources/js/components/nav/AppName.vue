<template>
    <router-link to="/dashboard">
        <div class="font-bold uppercase flex gap-2 items-center">
            <img class="h-7 -mt-1" src="@/assets/app-logo.png" alt="">
            <span>{{ app.APPNAME }}</span>
        </div>
    </router-link>
</template>

<script setup lang="ts">
    import { useAppStore } from '@/stores/app';
    const app = useAppStore();
</script>
