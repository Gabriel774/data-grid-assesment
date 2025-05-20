<script setup>
const emit = defineEmits('outClick');

const handleClick = (target) => {
    if (target.id === 'modal-container') {
        emit('outClick');
    }
};
</script>
<template>
    <div @click="({target}) => handleClick(target)" id="modal-container">

        <slot />
    </div>
</template>
<style>
#modal-container {
    background-color: rgba(0, 0, 0, 0.199);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    animation: appear .3s;
    z-index: 99;
    display: flex;
}
</style>