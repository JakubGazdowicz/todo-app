<script setup lang="ts">
import {TaskCategoryResource} from "@/Pages/Resources/TaskCategory.resource";
import {ref} from "vue";
import AppLayout from "@/layout/AppLayout.vue";
import handleRowClick from "@/utils/handleRowClick";
import CreateTaskCategoryModal from "@/Pages/TaskCategory/Components/CreateTaskCategoryModal.vue";

defineProps<{
    taskCategories: TaskCategoryResource[];
}>();

const isCreateTaskCategoryModalVisible = ref(false);
</script>

<template>
    <AppLayout>
        <div class="card">
            <div class="flex justify-between">
                <div class="font-semibold text-xl mb-4">
                    Kategorie zadań
                </div>
                <Button
                    icon="pi pi-plus"
                    label="Dodaj kategorię"
                    class="w-auto h-[3rem]"
                    size="large"
                    @click="isCreateTaskCategoryModalVisible = true"
                />
            </div>
            <DataTable
                :value="taskCategories"
                class="mt-4"
                :rowClass="() => 'cursor-pointer hover:bg-primary-400 transition-colors'"
                @row-click="handleRowClick('task-categories.show', $event)"
            >
                <template #empty>
                    <Message>Brak danych</Message>
                </template>
                <Column field="id" header="ID" />
                <Column field="name" header="Nazwa" />
                <Column field="createdAt" header="Utworzono" />
                <Column field="updatedAt" header="Zaktualizowano" />
            </DataTable>
        </div>
    </AppLayout>
    <CreateTaskCategoryModal v-model:active="isCreateTaskCategoryModalVisible" />
</template>

<style scoped lang="scss">

</style>
