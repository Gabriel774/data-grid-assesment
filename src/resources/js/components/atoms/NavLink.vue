<script lang="ts" setup>
const props = defineProps({
    label: { type: String, required: true },
    link: { type: String, required: true },
})
</script>

<template>
    <a class="" :href="props.link">{{ props.label }}</a>
</template>
