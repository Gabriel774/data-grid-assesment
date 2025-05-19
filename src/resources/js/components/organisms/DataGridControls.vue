<script setup lang="ts">
import dataGridStore from '@/store/dataGridStore';
import PageControls from '../molecules/PageControls.vue';
import FilterIcon from '../atoms/FilterIcon.vue'
import FiltersModal from './FiltersModal.vue';
import CloseIcon from '../atoms/CloseIcon.vue';
import { ref, computed } from 'vue';

const filtersModalOpen = ref<boolean>(false);
const store = dataGridStore();

function prettifyKey(key: string): string {
    return key
        .replace(/_/g, ' ')
        .replace(/\b\w/g, char => char.toUpperCase());
}

const tags: string[] = computed(() => Object.keys(store.activeFilters).filter((key) => key !== 'per_page'))
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

        <div class="active-filters">
            <div v-for="(tag, index) in tags" :key="index">
                <span>
                    {{ prettifyKey(tag) }}
                </span>

                <CloseIcon @click="() => store.setActiveFilters(tag, undefined)" />
            </div>
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

    .active-filters {
        display: flex;
        gap: 15px;

        div {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            background-color: var(--primary);
            padding: 5px 10px;
            color: #FFF;
            border-radius: 10px;
            cursor: pointer;
        }
    }
}
</style>
