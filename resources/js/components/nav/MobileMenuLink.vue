<template>
    <router-link :to="routeTo" v-if="visible">
        <div class="px-6 py-3 flex gap-4 items-center">
            <i :class="icon"></i>
            <div class="flex items-center justify-between w-full">
                <span> {{ linkName }} </span>
                <i class="pi pi-angle-right text-black dark:text-white/60"></i>
            </div>
        </div>
    </router-link>
</template>

<script setup lang="ts">
    import { computed } from 'vue';
    import { useRoute } from 'vue-router'
    const route = useRoute();

    const {
        linkName,
        routeTo,
        checkName,
        guard = true,
        piIcon
    } = defineProps<{
        linkName: string
        routeTo: string
        checkName: string
        guard: boolean
        piIcon: string
    }>()

    const icon = computed(() => {
        return `pi ${piIcon} text-black dark:text-white/60`
    })

    const visible = computed(() => {
        return (route.name != checkName) && guard
    })
</script>
