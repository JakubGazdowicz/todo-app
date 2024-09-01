<script setup>
import { ref } from 'vue';

import AppMenuItem from './AppMenuItem.vue';

const model = ref([
    {
        label: 'Home',
        icon: 'pi pi-home',
        items: [
            {
                label: 'Dashboard',
                icon: 'pi pi-fw pi-home',
                route: 'dashboard.index',
            },
            {
                label: 'Użytkownicy',
                icon: 'pi pi-fw pi-users',
                route: 'users.index',
            },
            {
                label: 'Kategorie zadań',
                icon: 'pi pi-fw pi-tags',
                route: 'task-categories.index',
            },
            {
                label: 'Zadania',
                icon: 'pi pi-fw pi-list',
                route: 'tasks.index'
            }
        ]
    },
]);
</script>

<template>
    <ul class="layout-menu">
        <template v-for="(item, i) in model" :key="item">
            <app-menu-item v-if="!item.separator" :item="item" :index="i"></app-menu-item>
            <li v-if="item.separator" class="menu-separator"></li>
        </template>
    </ul>
</template>

<style lang="scss" scoped></style>
