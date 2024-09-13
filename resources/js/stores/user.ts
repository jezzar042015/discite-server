import { get, post } from "@/composables/server";
import { APIUser } from "@/types/user";
import { defineStore } from "pinia";
import { computed, ref } from "vue";

export const useUserStore = defineStore('user', () => {

    const current = ref<APIUser | null>(null);
    const users = ref<APIUser[]>([])

    const getCurrent = async () => {
        const resp = await get('/api/user');
        current.value = (await resp?.json()) ?? null
    }

    const getUsers = async () => {
        const resp = await get('/api/users');
        users.value = (await resp?.json())?.data ?? []
    }

    const welcomeName = computed(() => {
        if (!current.value) return '';
        const name = current.value.name

        if (name.length > 20) {
            return name.split(' ')[0]
        } else {
            return name
        }
    })

    const canBrowse = computed(() => {
        if (!current.value) return false;
        return current.value.type !== "student"
    })

    const isAdmin = computed(() => {
        if (!current.value) return false;
        return current.value.type === "admin"
    })

    const logout = async () => {
        await post('/logout', '');
    }

    return {
        current, welcomeName, users, 
        getCurrent, getUsers, logout, 
        canBrowse, isAdmin
    }
})