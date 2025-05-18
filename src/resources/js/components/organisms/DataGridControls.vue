<script setup lang="ts">
import dataGridStore from '@/store/dataGridStore';
import PageControls from '../molecules/PageControls.vue';
import FilterIcon from '../atoms/FilterIcon.vue'
import FiltersModal from './FiltersModal.vue';
import { ref } from 'vue';

const filtersModalOpen = ref<boolean>(false);
const store = dataGridStore();
</script>

<template>
    <div class="data-grid-controls">
        <button @click="filtersModalOpen = true" class="btn">
            <span>
                Filters
            </span>

            <FilterIcon />
        </button>

        <div class="page-controls-container">
            <PageControls @next-page="store.fetchNextPage()" @previous-page="store.fetchPreviousPage()" />

            <span>Current page: {{ store.currentPage }}</span>
        </div>
    </div>

    <FiltersModal @close="filtersModalOpen = false" v-if="filtersModalOpen" />
</template>

<style scoped>
.data-grid-controls {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 10px;

    .page-controls-container {
        justify-self: flex-end;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 10px;
    } 
}
</style>