<script setup lang="ts">
import {TaskResource} from "@/Resources/Task.resource";
import {ref} from "vue";
import AppLayout from "@/layout/AppLayout.vue";
import handleRowClick from "@/utils/handleRowClick";
import CreateTaskModal from "@/Pages/Task/Components/CreateTaskModal.vue";
import {PaginateResource} from "@/Resources/Paginate.resource";

defineProps<{
    tasks: PaginateResource<TaskResource[]>;
}>();

const isCreateTaskModalVisible = ref(false);
</script>

<template>
    <AppLayout>
        <div class="card">
            <div class="flex justify-between">
                <div class="font-semibold text-xl mb-4">
                    Zadania
                </div>
                <Button
                    icon="pi pi-plus"
                    label="Dodaj zadanie"
                    class="w-auto h-[3rem]"
                    size="large"
                    @click="isCreateTaskModalVisible = true"
                />
            </div>
            <DataTable
                :value="tasks.data"
                class="mt-4"
                :rowClass="() => 'cursor-pointer hover:bg-primary-400 transition-colors'"
                @row-click="handleRowClick('tasks.show', $event)"
            >
                <template #empty>
                    <Message>Brak danych</Message>
                </template>
                <Column field="id" header="ID" />
                <Column field="name" header="Nazwa" />
                <Column field="durationMinutes" header="Przewidywany czas">
                    <template #body="{ data }">
                        {{ data.durationMinutes + ' minut' }}
                    </template>
                </Column>
                <Column field="createdAt" header="Utworzono" />
                <Column field="updatedAt" header="Zaktualizowano" />
            </DataTable>
        </div>
    </AppLayout>
    <CreateTaskModal v-model:active="isCreateTaskModalVisible" />
</template>

<style scoped lang="scss">

</style>
