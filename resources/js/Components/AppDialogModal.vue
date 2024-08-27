<script setup lang="ts">

defineProps<{
    title: string;
    processing: boolean;
}>();

const emit = defineEmits(['submit']);
</script>

<template>
    <Dialog
        modal
        :pt="{
            mask: {
                style: 'backdrop-filter: blur(2px); background-color: rgba(0, 0, 0, 0.5)',
            },
        }"
    >
        <template #header>
            <slot name="header"></slot>
            <div class="p-dialog-title">
                <span class="ml-1">{{ title }}</span>
            </div>
        </template>

        <slot name="fields"></slot>

        <template #footer>
            <slot name="footer">
                <div class="flex justify-end gap-2">
                    <Button
                        label="Zapisz"
                        icon="pi pi-check"
                        size="large"
                        class="w-auto h-[3rem]"
                        :loading="processing"
                        @click="emit('submit')"
                    />
                </div>
            </slot>
        </template>
    </Dialog>
</template>

<style scoped lang="scss">

</style>
