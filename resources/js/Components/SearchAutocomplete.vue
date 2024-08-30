<script setup lang="ts">
import axios from "axios";
import {ref} from "vue";
import {UserResource} from "@/Pages/Resources/User.resource";

const props = defineProps<{
    route: string;
}>();

const value = ref<UserResource>();
const suggestions = ref<UserResource[]>();

const handleSearch = ({query}) => {
    axios.get(route(props.route), {
        params: {
            query: query
        }
    }).then((response) => {
        suggestions.value = response.data;
    }).catch((error) => {
        console.log(error)
    })
}
</script>

<template>
    <AutoComplete
        v-model="value"
        dropdown
        :suggestions="suggestions"
        placeholder="Szukaj..."
        optionLabel="name"
        @complete="handleSearch"
    />
</template>

<style scoped lang="scss">

</style>
