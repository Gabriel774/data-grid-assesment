<script setup lang="ts">
import ModalContainer from '../molecules/ModalContainer.vue';
import NavLink from '../atoms/NavLink.vue';
import { route } from 'ziggy-js'

const emit = defineEmits('close')

</script>

<template>
    <ModalContainer @out-click="emit('close')">
        <div class="menu-mobile">
            <NavLink label="Home" @click="emit('close')" :link="route('home')" />

            <NavLink label="Movies" @click="emit('close')" :link="route('movies.list')" />

            <NavLink label="Users" @click="emit('close')" :link="route('user.list')" />
        </div>
    </ModalContainer>
</template>

<style>
.menu-mobile {
    background-color: #FFF;
    min-height: 250px;
    border-radius: 10px;
    margin: auto;
    min-width: 350px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    justify-content: center;
    align-items: center;

}
</style>
