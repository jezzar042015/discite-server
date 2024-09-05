<template>
    <div>
        Module Lessons

        <div class="flex flex-col gap-4">
            <router-link :to="{ name: 'Modules' }">Back to Modules</router-link>
        </div>

        <div class="flex flex-col gap-4">
            <router-link to="/lessons/id_One">
                Lesson 1 Content
            </router-link>
            <router-link to="/lessons/id_Two">
                Lesson 2 Content
            </router-link>
            <router-link to="/lessons/id_Three">
                Lesson 3 Content
            </router-link>
        </div>
    </div>
</template>

<script setup lang="ts">

</script>

<style scoped>

</style>