<script setup lang="ts">
import {useConfirm} from "primevue/useconfirm";
import {useToastHelper} from "@/Composables/useToastHelper";
import {TaskResource} from "@/Resources/Task.resource";
import {ref} from "vue";
import {router} from "@inertiajs/vue3";
import AppLayout from "@/layout/AppLayout.vue";
import ShowField from "@/Components/ShowField.vue";
import EditTaskModal from "@/Pages/Task/Components/EditTaskModal.vue";

const confirm = useConfirm();
const { toastSuccess, toastError } = useToastHelper();

const props = defineProps<{
    task: TaskResource;
}>();

const isEditTaskModalVisible = ref(false);

const confirmDelete = () => {
    confirm.require({
        message: 'Jesteś pewien, że chcesz usunąć zadanie?',
        header: 'Potwierdzenie usunięcia',
        icon: 'pi pi-exclamation-triangle',
        acceptLabel: 'Tak',
        rejectProps: {
            label: 'Nie',
            severity: 'secondary',
            outlined: true
        },
        accept: () => {
            router.delete(route('tasks.destroy', props.task.id), {
                onSuccess: () => {
                    toastSuccess('Zadanie zostało usunięte pomyślnie');
                },
                onError: () => {
                    toastError('Wystąpił błąd podczas usuwania zadania');
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
                <div class="text-3xl">#{{ task.id }} - {{ task.name }}</div>
                <div>
                    <Button
                        label="Edytuj"
                        icon="pi pi-pencil"
                        severity="help"
                        size="large"
                        class="w-auto h-3rem mr-2"
                        @click="isEditTaskModalVisible = true"
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
                        @click="router.get(route('tasks.index'))"
                    />
                </div>
            </div>
            <div class="grid grid-cols-1 card">
                <div class="px-4">
                    <div class="mb-4 text-gray-400">Informacje dotyczące zadania</div>
                    <ul class="p-0 m-0 list-none">
                        <ShowField label="ID" :value="task.id" />
                        <ShowField label="Nazwa" :value="task.name" />
                        <ShowField label="Przewidywany czas" :value="task.durationMinutes + ' minut'" />
                        <ShowField label="Przypisany użytkownik" :value="task.user?.name" />
                        <ShowField label="Przypisana kategoria" :value="task.taskCategory?.name" />
                        <ShowField label="Utworzono" :value="task.createdAt" />
                        <ShowField label="Zaktualizowano" :value="task.updatedAt" />
                        <ShowField label="Opis" :value="task.description" />
                    </ul>
                </div>
            </div>
        </div>
    </AppLayout>
    <EditTaskModal
        v-model:active="isEditTaskModalVisible"
        :task="task"
    />
</template>

<style scoped lang="scss">

</style>
