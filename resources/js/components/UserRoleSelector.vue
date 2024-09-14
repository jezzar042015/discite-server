<template>
    <div ref="selector" v-if="visible"
        class="absolute right-1 top-5 bg-white/80 text-black/60 dark:bg-black/50 dark:text-white/60 whitespace-nowrap py-1 rounded shadow">
        <div class="px-3 pb-1 border-b border-gray-200 dark:border-gray-700">
            Assign as:
        </div>
        <div>
            <ul class="text-sm">
                <li v-for="role in roles" :key="role.type" @click="assignRole(role.type)"
                    v-show="currentRole !== role.type"
                    class="px-3 py-1 flex items-center gap-4 hover:bg-white hover:text-black hover:dark:text-white transition duration-300">
                    <i :class="role.icon" style="font-size: .9em;"></i>
                    {{ role.label }}
                </li>

            </ul>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { UserType } from '@/types/user';
    import { onClickOutside } from '@vueuse/core'
    import { ref } from 'vue';

   
    const { currentRole, visible } = defineProps<{
        currentRole: UserType,
        visible: boolean
    }>()

    const roles = ref<{
        type: UserType,
        icon: string,
        label: string
    }[]>([
        { type: "admin", icon: 'pi pi-shield', label: "Admin" },
        { type: "dev", icon: 'pi pi-code', label: "Developer" },
        { type: "author", icon: 'pi pi-pencil', label: "Author/Contributor" },
        { type: 'student', icon: 'pi pi-lightbulb', label: "Student" },
    ]);

    const emits = defineEmits(['hide-selector','assign-role'])

    const selector = ref(null)
    onClickOutside(selector, (e) => { emits('hide-selector') })
    const assignRole = (role: UserType) => emits('assign-role', role) 
</script>
