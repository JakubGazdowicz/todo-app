<script setup lang="ts">

import AppLayout from "@/layout/AppLayout.vue";
import {UserResource} from "@/Resources/User.resource";
import {ref} from "vue";
import CreateUserModal from "@/Pages/User/Components/CreateUserModal.vue";
import handleRowClick from "@/utils/handleRowClick";
import {PaginateResource} from "@/Resources/Paginate.resource";

defineProps<{
    users: PaginateResource<UserResource[]>;
}>();

const isCreateUserModalVisible = ref(false);
</script>

<template>
    <AppLayout>
        <div class="card">
            <div class="flex justify-between">
                <div class="font-semibold text-xl mb-4">
                    Użytkownicy
                </div>
                <Button
                    icon="pi pi-plus"
                    label="Dodaj użytkownika"
                    class="w-auto h-[3rem]"
                    size="large"
                    @click="isCreateUserModalVisible = true"
                />
            </div>
            <DataTable
                :value="users.data"
                class="mt-4"
                :rowClass="() => 'cursor-pointer hover:bg-primary-400 transition-colors'"
                @row-click="handleRowClick('users.show', $event)"
            >
                <template #empty>
                    <Message>Brak danych</Message>
                </template>
                <Column field="id" header="ID" />
                <Column field="name" header="Nazwa" />
                <Column field="remainingMinutes" header="Pozostały czas">
                    <template #body="{ data }">
                        {{ data.remainingMinutes + ' minut' }}
                    </template>
                </Column>
                <Column field="email" header="Email" />
                <Column field="createdAt" header="Utworzono" />
                <Column field="updatedAt" header="Zaktualizowano" />
            </DataTable>
        </div>
    </AppLayout>
    <CreateUserModal v-model:active="isCreateUserModalVisible" />
</template>

<style scoped lang="scss">

</style>
