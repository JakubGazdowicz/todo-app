import { useToast } from 'primevue/usetoast';

export function useToastHelper() {
    const toast = useToast();

    const toastSuccess = (detail = 'Operacja powiodła się', summary = 'Sukces', life = 3000) => {
        toast.add({
            severity: 'success',
            summary: summary,
            detail: detail,
            life: life,
        });
    };

    const toastError = (detail = 'Wystąpił nieoczekiwany błąd', summary = 'Błąd', life = 3000) => {
        toast.add({
            severity: 'error',
            summary: summary,
            detail: detail,
            life: life,
        });
    };

    const toastInfo = (detail = 'Informacja', summary = 'Info', life = 3000) => {
        toast.add({
            severity: 'info',
            summary: summary,
            detail: detail,
            life: life,
        });
    };

    const toastWarning = (detail = 'Ostrzeżenie', summary = 'Uwaga', life = 3000) => {
        toast.add({
            severity: 'warn',
            summary: summary,
            detail: detail,
            life: life,
        });
    };

    return { toastSuccess, toastError, toastInfo, toastWarning };
}
