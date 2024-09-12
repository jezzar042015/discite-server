import { defineStore } from "pinia";
import { ref } from "vue";

export const useAppStore = defineStore('app', () => {
    const APPNAME = ref('Discite Admin')

    return {
        APPNAME
    }
})