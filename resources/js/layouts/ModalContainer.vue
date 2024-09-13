<template>
    <teleport to='#app'>
        <div v-if="isVisible"
            class="bg-black/80 fixed h-dvh w-screen grid place-items-center px-0 z-20 mt-0 dark:bg-black/75 dark:shadow-sm">
            <div
                class="flex flex-col bg-white shadow h-screen w-full md:h-5/6 md:w-3/4 md:rounded-lg p-4 md:p-6 dark:bg-gray-800 md:-mt-20">
                <slot name="head"></slot>

                <div class="overflow-y-auto flex-1 flex flex-col py-4 gap-10">
                    <slot name="main">

                    </slot>
                </div>
                <slot name="foot"></slot>
            </div>
        </div>
    </teleport>
</template>

<script setup lang="ts">
    const { isVisible = false } = defineProps<{
        isVisible: boolean
    }>()
</script>

<style scoped>
    @media (prefers-color-scheme: light)
    {
        .jtbg
        {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%233B4D56"><path d="M0 1v99c134.3 0 153.7-99 296-99H0Z" opacity=".5"></path><path d="M1000 4v86C833.3 90 833.3 3.6 666.7 3.6S500 90 333.3 90 166.7 4 0 4h1000Z" opacity=".5"></path><path d="M617 1v86C372 119 384 1 196 1h421Z" opacity=".5"></path><path d="M1000 0H0v52C62.5 28 125 4 250 4c250 0 250 96 500 96 125 0 187.5-24 250-48V0Z"></path></svg>');
            background-attachment: fixed;
            background-size: cover;
            background-blend-mode: color-burn;
        }
    }

    @media (prefers-color-scheme: dark)
    {
        .jtbg
        {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%23042E41"><path d="M0 1v99c134.3 0 153.7-99 296-99H0Z" opacity=".5"></path><path d="M1000 4v86C833.3 90 833.3 3.6 666.7 3.6S500 90 333.3 90 166.7 4 0 4h1000Z" opacity=".5"></path><path d="M617 1v86C372 119 384 1 196 1h421Z" opacity=".5"></path><path d="M1000 0H0v52C62.5 28 125 4 250 4c250 0 250 96 500 96 125 0 187.5-24 250-48V0Z"></path></svg>');
            background-attachment: fixed;
            background-size: cover;
        }
    }
</style>
