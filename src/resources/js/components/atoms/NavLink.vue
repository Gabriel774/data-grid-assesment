<script lang="ts" setup>
import { Link } from '@inertiajs/inertia-vue3'

const props = defineProps({
    label: { type: String, required: true },
    link: {
        type: String, required: true, validator: (value: string) => {
            const isHttpUrl = /^https?:\/\/[^\s/$.?#].[^\s]*$/i.test(value);
            const isRelativePath = /^\/[\w\-\/]*$/.test(value);

            return isHttpUrl || isRelativePath;
        }
    },
})

</script>

<template>
    <Link :href="props.link">{{ props.label }}</Link>
</template>

<style scoped>
a {
    text-decoration: none;
    color: #222c47;
}

a:hover {
    text-decoration: underline;
}
</style>
