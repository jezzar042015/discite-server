<template>
    <li :class="active">
        <router-link :to="{ name: routerToName }">{{ navDisplayName }}</router-link>
    </li>
</template>

<script setup lang="ts">
    import { computed } from 'vue';
    import { useRoute } from 'vue-router';

    const route = useRoute();

    const {
        routerToName,
        navDisplayName,
    } = defineProps<{
        routerToName: string
        navDisplayName: string
    }>()

    const active = computed(() => {
        return (route.name === routerToName) ?
            'py-1 px-3 border-b-2 font-bold border-sky-500/65' :
            'py-1 px-3 border-b-2 border-transparent'
    })
</script>
