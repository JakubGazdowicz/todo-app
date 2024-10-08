<script setup lang="ts">
import {useToastHelper} from "@/Composables/useToastHelper";
import {TaskCategoryResource} from "@/Resources/TaskCategory.resource";
import {useForm} from "@inertiajs/vue3";
import AppDialogModal from "@/Components/AppDialogModal.vue";
import {UserResource} from "@/Resources/User.resource";
import SearchAutocomplete from "@/Components/SearchAutocomplete.vue";

const { toastSuccess, toastError } = useToastHelper();

const props = defineProps<{
    taskCategory: TaskCategoryResource;
}>();

const active = defineModel<boolean>('active');

const form = useForm<{
    name: string;
    user_id: number | null;
    user: UserResource | null;
}>({
    name: props.taskCategory.name,
    user_id: props.taskCategory?.userId,
    user: null,
});

const handleSubmit = () => {
    form.transform((data) => ({
        ...data,
        user_id: data.user?.id,
    })).put(route('task-categories.update', props.taskCategory.id), {
        onSuccess: () => {
            toastSuccess('Kategoria została zaktualizowana pomyślnie!');
            active.value = false;
        },
        onError: () => {
            toastError('Wystąpił błąd podczas aktualizowania kategorii');
        },
        preserveScroll: true,
    });
}
</script>

<template>
    <AppDialogModal
        v-model:visible="active"
        title="Dodaj użytkownika"
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
                    placeholder="Podaj nazwę użytkownika"
                    :class="{ 'p-invalid': form.errors.name }"
                    @change="form.clearErrors('name')"
                />
                <label class="p-1 p-invalid text-red-500">{{ form.errors.name }}</label>
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
        </template>
    </AppDialogModal>
</template>

<style scoped lang="scss">

</style>
