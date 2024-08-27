<script setup lang="ts">
import {useToastHelper} from "@/Composables/useToastHelper";
import {UserResource} from "@/Pages/Resources/User.resource";
import {useForm} from "@inertiajs/vue3";
import AppDialogModal from "@/Components/AppDialogModal.vue";

const { toastSuccess, toastError } = useToastHelper();

const props = defineProps<{
    user: UserResource;
}>()

const active = defineModel<boolean>('active');

const form = useForm<{
    name: string;
    email: string;
}>({
    name: props.user.name,
    email: props.user.email,
});

const handleSubmit = () => {
    form.put(route('users.update', props.user.id), {
        onSuccess: () => {
            toastSuccess('Użytkownik został zaktualizowany pomyślnie!');
            active.value = false;
        },
        onError: () => {
            toastError('Wystąpił błąd podczas aktualizowania użytkownika');
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
                <label for="name">Nazwa</label>
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
                <label for="email">Email</label>
                <InputText
                    id="email"
                    v-model="form.email"
                    maxlength="255"
                    placeholder="Podaj adres email"
                    :class="{ 'p-invalid': form.errors.email }"
                    @change="form.clearErrors('email')"
                />
                <label class="p-1 p-invalid text-red-500">{{ form.errors.email }}</label>
            </div>
        </template>
    </AppDialogModal>
</template>

<style scoped lang="scss">

</style>
