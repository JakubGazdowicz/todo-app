import { router } from '@inertiajs/vue3';

export function handleRowClick(routeName: string, event: PointerEvent) {
    router.get(route(routeName, event.data.id));
}
export default handleRowClick;
