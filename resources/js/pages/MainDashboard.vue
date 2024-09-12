<template>
    <Authenticated>

        <template #header>
            <div>
                Main Dashboard
                <div>
                    <router-link :to="{ name: 'Courses' }">See Courses</router-link>
                </div>
            </div>
        </template>
    </Authenticated>
</template>

<script setup lang="ts">
    import Authenticated from '@/layouts/Authenticated.vue';


</script>
