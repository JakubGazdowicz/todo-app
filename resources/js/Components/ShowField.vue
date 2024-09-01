<script setup lang="ts">
defineProps<{
    label: string;
    value: string | number | undefined | null;
}>()
</script>

<template>
    <li class="flex flex-wrap items-center border-t border-surface px-2 py-3">
        <div class="w-1/4 text-500">
            {{ label }}
        </div>
        <div class="w-3/4 text-900 flex-order-1">
            {{ value ?? '-' }}
        </div>
    </li>
</template>

<style scoped lang="scss">

</style>
