<template>
    <div>
        Lesson's Content

        <div class="flex flex-col gap-4">
            <router-link :to="{ name: 'Lessons' }">Back to All Lessons</router-link>
        </div>

        <div class="flex flex-col gap-4">
            <router-link to="/lessons/gdvsldklkjie939jjjl/exercises">See Lesson's Exercises</router-link>
        </div>
    </div>
</template>

<script setup lang="ts">

</script>

<style scoped>

</style>