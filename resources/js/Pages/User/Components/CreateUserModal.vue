<script setup lang="ts">
import AppDialogModal from "@/Components/AppDialogModal.vue";
import {useForm} from "@inertiajs/vue3";
import {useToastHelper} from "@/Composables/useToastHelper";

const { toastSuccess, toastError } = useToastHelper();

const active = defineModel<boolean>('active');

const form = useForm<{
    name: string;
    email: string;
    password: string;
}>({
   name: '',
   email: '',
   password: '',
});

const handleSubmit = () => {
    form.post(route('users.store'), {
        onSuccess: () => {
            toastSuccess('Użytkownik został utworzony pomyślnie!');
            active.value = false;
        },
        onError: () => {
            toastError('Wystąpił błąd podczas tworzenia użytkownika');
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
            <div class="flex flex-col gap-2">
                <label for="password">Hasło</label>
                <Password
                    id="password"
                    v-model="form.password"
                    maxlength="255"
                    placeholder="Podaj hasło"
                    toggleMask
                    fluid
                    :class="{ 'p-invalid': form.errors.password }"
                    @change="form.clearErrors('password')"
                />
                <label class="p-1 p-invalid text-red-500">{{ form.errors.password }}</label>
            </div>
        </template>
    </AppDialogModal>
</template>

<style scoped lang="scss">

</style>
