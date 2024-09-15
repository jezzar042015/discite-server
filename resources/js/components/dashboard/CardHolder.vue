<template>
    <div class="bg-white dark:bg-gray-700 w-full p-4 rounded-lg ">
        <div class="flex flex-col gap-2">
            <div>
                <slot name="title">Card Title</slot>
            </div>
            
            <div>
                <slot name="body">No items yet</slot>

            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

</script>
