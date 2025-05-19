<script lang="ts" setup>
import NavBar from '@/components/organisms/NavBar.vue'
</script>

<template>
    <NavBar />

    <main>
        <div class="main-container">
            <slot />
        </div>
    </main>
</template>

<style scoped>
main {
    height: calc(100dvh - 82px);
    overflow-y: auto;
    padding: 0 10%;

    @media (max-width: 1200px) {
       padding: 0 5%; 
    }

    .main-container {
        display: flex;
        flex-direction: column;
        max-width: 1440px;
        margin: 30px auto;
    }
}
</style>
