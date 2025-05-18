<script setup lang="ts">
import dataGridStore from '@/store/dataGridStore';
import PageControls from '../molecules/PageControls.vue';

const store = dataGridStore();
</script>

<template>
    <div style="display: flex;">
        <PageControls @next-page="store.fetchNextPage()" @previous-page="store.fetchPreviousPage()" />
    </div>
</template>

<style></style>