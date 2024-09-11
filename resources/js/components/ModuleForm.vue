<template>
    <ModalContainer>
        <div v-if="visible"
            class="bg-black/80 fixed h-screen w-screen grid place-items-center px-2 z-20 mt-0 dark:bg-black/75 dark:shadow-sm">
            <div class="flex flex-col bg-white shadow h-4/5 md:h-5/6 md:w-3/4 rounded-lg p-6 dark:bg-gray-800 -mt-20">
                <div class="h-6 font-extrabold text-md text-sky-400 uppercase">
                    {{ formTitle }}
                </div>

                <div class="flex-1 flex flex-col py-4 gap-4">
                    <div class="flex flex-col w-full gap-2">
                        <label class="uppercase text-xs" for="">Module Title</label>
                        <InputText type="text" v-model="data.title" />
                    </div>

                    <div class="flex flex-col w-full gap-2">
                        <label class="uppercase text-xs" for="description">Description</label>
                        <Textarea id="description" v-model="data.description" fluid autoResize rows="8" />
                    </div>

                    <div class="flex gap-10">
                        <div class="flex items-center gap-4">
                            <ToggleSwitch inputId="published" v-model="data.publish" />
                            <label class="uppercase text-xs w-16 cursor-pointer" for="published">Published</label>
                        </div>
                        <div class="flex items-center gap-4">
                            <ToggleSwitch inputId="premium" v-model="data.is_premium" />
                            <label class="uppercase text-xs w-16 cursor-pointer" for="premium">Premium</label>
                        </div>
                    </div>
                </div>

                <div class="h-12 flex gap-3 p-1">
                    <Button @click="save" label="Save" text raised />
                    <Button @click="close" severity="secondary" label="Discard" text raised />
                </div>
            </div>
        </div>
    </ModalContainer>
</template>

<script setup lang="ts">
    import ModalContainer from '@/layouts/ModalContainer.vue';
    import { computed } from 'vue';
    import { APIModuleRequest } from '@/types/module';
    import Button from 'primevue/button';
    import InputText from 'primevue/inputtext';
    import Textarea from 'primevue/textarea';
    import ToggleSwitch from 'primevue/toggleswitch';
    import { useModulesStore } from '@/stores/modules';


    const { visible, mode, data, } = defineProps<{
        visible: boolean,
        mode: 'new' | 'update',
        data: APIModuleRequest,
    }>();

    const emits = defineEmits(['close-me'])
    const moduleStore = useModulesStore();

    const formTitle = computed(() => {
        return `${mode == 'new' ? 'New' : 'Update'} Module`
    })

    async function save() {
        if (mode === 'update') {
            await moduleStore.update(data);
        } else {
            await moduleStore.insert(data);
        }
        
        emits('close-me');
    }

    async function close() {
        emits('close-me')
    }
</script>
