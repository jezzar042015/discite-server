<template>
    <Authenticated :is-fetching="isFetching">
        <template #header>
            <div>
                Hi Me!
            </div>
        </template>

    </Authenticated>
</template>

<script setup lang="ts">
    import Authenticated from '@/layouts/Authenticated.vue';
    import { useUserStore } from '@/stores/user';
    import { onMounted, ref } from 'vue';

    const isFetching = ref(false)
    const user = useUserStore()

    onMounted(async () => {
        if (user.current) return
        isFetching.value = true
        await user.getCurrent()
        isFetching.value = false
    })
</script>
