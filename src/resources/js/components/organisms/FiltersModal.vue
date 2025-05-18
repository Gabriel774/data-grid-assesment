<script setup lang="ts">
import ModalContainer from '../molecules/ModalContainer.vue';

import dataGridStore from '@/store/dataGridStore';

const store = dataGridStore();
const emit = defineEmits('close')

const applyFilters = (): void => {
    store.applyPendingFilters();

    emit('close');
}

</script>

<template>
    <ModalContainer @out-click="emit('close')">
        <div class="filters-modal">
            <button @click="applyFilters" class="btn">Apply filters</button>

            <div class="input-container">
                <label for="per-page-select">
                    Per page
                </label>

                <select :value="store.pendingFilters.per_page || 10"
                    @change="({ target }) => store.setPendingFilters('per_page', target.value)" id="per-page-select">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>


        </div>
    </ModalContainer>
</template>

<style>
.filters-modal {
    background-color: #FFF;
    height: 100dvh;
    margin-left: auto;
    animation: enterFromRight .3s ease;
    min-width: 350px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 20px;

    .input-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
        width: 100%;

        label {
            font-size: 14px;
            font-weight: 600;
        }

        select {
            outline: none;
            border: 1px solid #CCC;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #FFF;
        }
    }
}
</style>
