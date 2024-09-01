<script setup lang="ts">
import {useConfirm} from "primevue/useconfirm";
import {useToastHelper} from "@/Composables/useToastHelper";
import {TaskCategoryResource} from "@/Resources/TaskCategory.resource";
import {ref} from "vue";
import {router} from "@inertiajs/vue3";
import AppLayout from "@/layout/AppLayout.vue";
import ShowField from "@/Components/ShowField.vue";
import EditTaskCategoryModal from "@/Pages/TaskCategory/Components/EditTaskCategoryModal.vue";

const confirm = useConfirm();
const { toastSuccess, toastError } = useToastHelper();

const props = defineProps<{
    taskCategory: TaskCategoryResource;
}>();

const isEditTaskCategoryModalVisible = ref(false);

const confirmDelete = () => {
    confirm.require({
        message: 'Jesteś pewien, że chcesz usunąć kategorię?',
        header: 'Potwierdzenie usunięcia',
        icon: 'pi pi-exclamation-triangle',
        acceptLabel: 'Tak',
        rejectProps: {
            label: 'Nie',
            severity: 'secondary',
            outlined: true
        },
        accept: () => {
            router.delete(route('task-categories.destroy', props.taskCategory.id), {
                onSuccess: () => {
                    toastSuccess('Kategoria została usunięta pomyślnie');
                },
                onError: () => {
                    toastError('Wystąpił błąd podczas usuwania kategorii');
                },
                preserveScroll: true,
            });
        },
    });
};
</script>

<template>
    <AppLayout>
        <div class="card">
            <div class="flex justify-between items-center">
                <div class="text-3xl">#{{ taskCategory.id }} - {{ taskCategory.name }}</div>
                <div>
                    <Button
                        label="Edytuj"
                        icon="pi pi-pencil"
                        severity="help"
                        size="large"
                        class="w-auto h-3rem mr-2"
                        @click="isEditTaskCategoryModalVisible = true"
                    />
                    <Button
                        label="Usuń"
                        icon="pi pi-trash"
                        severity="danger"
                        size="large"
                        class="w-auto h-3rem mr-2"
                        @click="confirmDelete"
                    />
                    <Button
                        label="Lista"
                        icon="pi pi-chevron-left"
                        severity="info"
                        size="large"
                        class="w-auto h-3rem"
                        @click="router.get(route('task-categories.index'))"
                    />
                </div>
            </div>
            <div class="grid grid-cols-1 card">
                <div class="px-4">
                    <div class="mb-4 text-gray-400">Informacje dotyczące kategorii</div>
                    <ul class="p-0 m-0 list-none">
                        <ShowField label="ID" :value="taskCategory.id" />
                        <ShowField label="Nazwa" :value="taskCategory.name" />
                        <ShowField label="Przypisany użytkownik" :value="taskCategory.user?.name" />
                        <ShowField label="Utworzono" :value="taskCategory.createdAt" />
                        <ShowField label="Zaktualizowano" :value="taskCategory.updatedAt" />
                    </ul>
                </div>
            </div>
        </div>
    </AppLayout>
    <EditTaskCategoryModal
        v-model:active="isEditTaskCategoryModalVisible"
        :taskCategory="taskCategory"
    />
</template>

<style scoped lang="scss">

</style>
