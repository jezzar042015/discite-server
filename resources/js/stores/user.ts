import { get, post } from "@/composables/server";
import { defineStore } from "pinia";
import { ref } from "vue";

export const useUserStore = defineStore('user', () => {

    const current = ref({});

    const getCurrent = async () => {
        const resp = await get('/api/user');
        if (resp && resp.ok) {
            current.value = await resp.json()
        }
    }

    const logout = async () => {
        await post('/logout', '');
    }

    return {
        current, getCurrent, logout
    }
})