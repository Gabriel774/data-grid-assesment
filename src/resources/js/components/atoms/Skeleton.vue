<script setup>
const props = defineProps({
    width: {
        type: Number,
    },
    height: {
        type: Number
    }
})
</script>

<template>
    <div :style="{ width: props.width + 'px', height: props.height + 'px' }" class="skeleton" />
</template>

<style scoped>
.skeleton {
    background-color: #ccc;
    position: relative;
    overflow: hidden;
    border-radius: 5px;
}

.skeleton::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background: linear-gradient(90deg,
            transparent,
            #9c9c9c,
            transparent);
    animation: wave 1s infinite alternate;
    z-index: 2;
}
</style>
