<script lang="ts" setup>
import { Link } from '@inertiajs/inertia-vue3'

const props = defineProps({
    label: { type: String, required: true },
    link: {
        type: String, required: true, validator: (value: string) => {
            const isAbsoluteUrl = /^https?:\/\/[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!$&'()*+,;=.]+$/.test(value);
            const isRelativePath = /^\/[a-zA-Z0-9-_\/]*$/.test(value);

            return isAbsoluteUrl || isRelativePath;
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
</style>
