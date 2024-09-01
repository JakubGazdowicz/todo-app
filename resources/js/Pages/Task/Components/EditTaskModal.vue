<script setup lang="ts">
import {useToastHelper} from "@/Composables/useToastHelper";
import {TaskResource} from "@/Resources/Task.resource";
import {useForm} from "@inertiajs/vue3";
import {UserResource} from "@/Resources/User.resource";
import {TaskCategoryResource} from "@/Resources/TaskCategory.resource";
import SearchAutocomplete from "@/Components/SearchAutocomplete.vue";
import AppDialogModal from "@/Components/AppDialogModal.vue";

const { toastSuccess, toastError } = useToastHelper();

const props = defineProps<{
    task: TaskResource;
}>();

const active = defineModel<boolean>('active');

const form = useForm<{
    name: string;
    description: string | null;
    duration_minutes: number;
    user_id: number | null;
    user: UserResource | null;
    task_category_id: number | null;
    taskCategory: TaskCategoryResource | null;
}>({
    name: props.task.name,
    description: props.task.description,
    duration_minutes: props.task.durationMinutes,
    user_id: props.task?.userId,
    user: props.task?.user,
    task_category_id: props.task.taskCategoryId,
    taskCategory: props.task.taskCategory,
});

const handleSubmit = () => {
    form.transform((data) => ({
        ...data,
        user_id: data.user?.id,
        task_category_id: data.taskCategory?.id,
    }))
        .put(route('tasks.update', props.task.id), {
        onSuccess: () => {
            toastSuccess('Zadanie zostało zaktualizowane pomyślnie!');
            active.value = false;
        },
        onError: () => {
            toastError('Wystąpił błąd podczas aktualizowania zadania');
        },
        preserveScroll: true,
    });
}
</script>

<template>
    <AppDialogModal
        v-model:visible="active"
        title="Dodaj zadanie"
        :processing="form.processing"
        @submit="handleSubmit"
        class="w-3/4 md:w-1/2 lg:w-1/3"
    >
        <template #fields>
            <div class="flex flex-col gap-2">
                <label for="name">Nazwa<span class="text-red-500"> *</span></label>
                <InputText
                    id="name"
                    v-model="form.name"
                    maxlength="255"
                    placeholder="Podaj nazwę kategorii"
                    :class="{ 'p-invalid': form.errors.name }"
                    @change="form.clearErrors('name')"
                />
                <label class="p-1 p-invalid text-red-500">{{ form.errors.name }}</label>
            </div>
            <div class="flex flex-col gap-2">
                <label for="duration_minutes">Przewidywany czas<span class="text-red-500"> *</span></label>
                <InputNumber
                    id="duration_minutes"
                    v-model="form.duration_minutes"
                    :min="0"
                    :max="9600"
                    placeholder="Podaj przewiduwany czas"
                    suffix=" minut"
                    showButtons
                    @change="form.clearErrors('duration_minutes')"
                />
            </div>
            <div class="flex flex-col gap-2">
                <label for="user">Użytkownik</label>
                <SearchAutocomplete
                    id="user"
                    v-model="form.user"
                    route="api.users.search"
                />
                <label class="p-1 p-invalid text-red-500">{{ form.errors.user_id }}</label>
            </div>
            <div class="flex flex-col gap-2">
                <label for="taskCategory">Kategoria</label>
                <SearchAutocomplete
                    id="taskCategory"
                    v-model="form.taskCategory"
                    route="api.task-categories.search"
                />
                <label class="p-1 p-invalid text-red-500">{{ form.errors.task_category_id }}</label>
            </div>
            <div class="flex flex-col gap-2">
                <label for="description">Opis</label>
                <Textarea
                    id="description"
                    v-model="form.description"
                    maxlength="255"
                    rows="5"
                    cols="30"
                    autoResize
                    placeholder="Podaj opis zadania"
                    :class="{ 'p-invalid': form.errors.description }"
                    @change="form.clearErrors('description')"
                />
                <label class="p-1 p-invalid text-red-500">{{ form.errors.description }}</label>
            </div>
        </template>
    </AppDialogModal>
</template>

<style scoped lang="scss">

</style>
