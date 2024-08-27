<script setup lang="ts">
import {useToastHelper} from "@/Composables/useToastHelper";
import {UserResource} from "@/Pages/Resources/User.resource";
import {useConfirm} from "primevue/useconfirm";
import {router} from "@inertiajs/vue3";
import AppLayout from "@/layout/AppLayout.vue";
import ShowField from "@/Components/ShowField.vue";
import {ref} from "vue";
import EditUserModal from "@/Pages/User/Components/EditUserModal.vue";

const confirm = useConfirm();
const { toastSuccess, toastError } = useToastHelper();

const props = defineProps<{
    user: UserResource;
}>();

const isEditUserModalVisible = ref(false);

const confirmDelete = () => {
    confirm.require({
        message: 'Jesteś pewien, że chcesz usunąć użytkownika?',
        header: 'Potwierdzenie usunięcia',
        icon: 'pi pi-exclamation-triangle',
        acceptLabel: 'Tak',
        rejectProps: {
            label: 'Nie',
            severity: 'secondary',
            outlined: true
        },
        accept: () => {
            router.delete(route('users.destroy', props.user.id), {
                onSuccess: () => {
                    toastSuccess('Użytkownik został usunięty pomyślnie');
                },
                onError: () => {
                    toastError('Wystąpił błąd podczas usuwania użytkownika');
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
                <div class="text-3xl">#{{ user.id }} - {{ user.name }}</div>
                <div>
                    <Button
                        label="Edytuj"
                        icon="pi pi-pencil"
                        severity="help"
                        size="large"
                        class="w-auto h-3rem mr-2"
                        @click="isEditUserModalVisible = true"
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
                        @click="router.get(route('users.index'))"
                    />
                </div>
            </div>

        </div>
        <div class="grid grid-cols-2 card">
            <div class="px-4">
                <div class="mb-4 text-gray-400">Informacje dotyczące użytkownika</div>
                <ul class="p-0 m-0 list-none">
                    <ShowField label="ID" :value="user.id" />
                    <ShowField label="Nazwa" :value="user.name" />
                    <ShowField label="Email" :value="user.email" />
                    <ShowField label="Utworzono" :value="user.createdAt" />
                    <ShowField label="Zaktualizowano" :value="user.updatedAt" />
                </ul>
            </div>

            <div class="px-4">
                <div class="mb-4 text-gray-400">Zadania przypisane do użytkownika</div>

            </div>
        </div>
    </AppLayout>
    <EditUserModal v-model:active="isEditUserModalVisible" :user="user" />
</template>

<style scoped lang="scss">

</style>
