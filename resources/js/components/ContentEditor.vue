<template>
    <Editor v-model="localModelValue" @update:modelValue="changeNotificationQuillEditor" editorStyle="height: 18em" @load="onLoad" />
</template>

<script lang="ts">
    import { defineComponent, ref, PropType } from 'vue';
    import Editor from 'primevue/editor';

    export default defineComponent(
        {
            name: 'TextEditor',
            props: {
                modelValue: { type: String, required: true },
                changeNotificationQuillEditor: { type: Function as PropType<(value: string) => void>, required: true },
            },
            components: { Editor },
            setup(props: any) {
                const localModelValue = ref(props.modelValue);
                const onLoad = ({ instance }: any) => {
                    instance.setContents(
                        instance.clipboard.convert({ html: props.modelValue })
                    );
                };
                return {
                    onLoad, localModelValue
                };
            }
        });
</script>
